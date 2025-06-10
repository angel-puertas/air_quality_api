<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Measurement.class.php');
require_once('system/AppCore.class.php');
header('Content-Type: application/json');

class ApiPage extends AbstractPage 
{
    protected $templateName = ''; //outputs JSON (for now i guess)

    public function execute() 
    {
        $station = $_GET['station'] ?? null;
        $pollutant = $_GET['pollutant'] ?? null;
        $type = $_GET['type']  ?? null;
        $fromDate = $_GET['fromDate'] ?? null;
        $toDate = $_GET['toDate'] ?? null;

        //validinf presense of parameters
        if ($station === null || $pollutant === null || $type === null || $fromDate === null || $toDate === null) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters.']);
            exit;
        }

        //validating parameters' format
        if (!ctype_digit($station)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "postaja" must be a number.']);
            exit;
        }
        if (!ctype_digit($pollutant)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "polutant" must be a number.']);
            exit;
        }
        if (!ctype_digit($type)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "tipPodatka" must be a number.']);
            exit;
        }

        $datePattern = '/^\d{2}\.\d{2}\.\d{4}$/';
        if (!preg_match($datePattern, $fromDate)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "fromDate" must be in format dd.mm.yyyy.']);
            exit;
        }
        if (!preg_match($datePattern, $toDate)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "toDate" must be in format dd.mm.yyyy.']);
            exit;
        }

        $apiUrl = "https://iszz.azo.hr/iskzl/rs/podatak/export/json?postaja=$station&polutant=$pollutant&tipPodatka=$type" .
            "&vrijemeOd=$fromDate&vrijemeDo=$toDate";


        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $httpCode !== 200) 
        {
            http_response_code(502);
            echo json_encode(['error' => 'Failed to fetch data from external API.']);
            exit;
        }

        
        $data = json_decode($response, true);
        if (!is_array($data)) 
        {
            http_response_code(500);
            echo json_encode(['error' => 'Invalid data format from external API.']);
            exit;
        }

        $db = \AppCore::getDB();
        $measurementModel = new \Measurement($db);

        foreach ($data as $item) {
            $value = $item['vrijednost'] ?? null;
            $unit = $item['mjernaJedinica'] ?? '';
            $time = $item['vrijeme'] ?? '';
            if ($value !== null && $time !== '') 
            {
                $measurementModel->create($station, $pollutant, $value, $unit, $time);
            }
        }

        $measurements = $measurementModel->getByStationAndPollutant($station, $pollutant);
        echo json_encode($measurements, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
?>