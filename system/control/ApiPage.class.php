<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class ApiPage extends AbstractPage 
{
    protected $templateName = ''; //outputs JSON (for now i guess)

    public function execute() 
    {
        $station = $_GET['postaja'] ?? null;
        $pollutant = $_GET['polutant'] ?? null;
        $type = $_GET['tipPodatka']  ?? null;
        $from = $_GET['vrijemeOd'] ?? null;
        $to = $_GET['vrijemeDo'] ?? null;

        //validinf presense of parameters
        if ($station === null || $pollutant === null || $type === null || $from === null || $to === null) 
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
        if (!preg_match($datePattern, $from)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "vrijemeOd" must be in format dd.mm.yyyy.']);
            exit;
        }
        if (!preg_match($datePattern, $to)) 
        {
            http_response_code(400);
            echo json_encode(['error' => 'Parameter "vrijemeDo" must be in format dd.mm.yyyy.']);
            exit;
        }

        $apiUrl = "https://iszz.azo.hr/iskzl/rs/podatak/export/json?postaja=$station&polutant=$pollutant&tipPodatka=$type" .
            "&vrijemeOd=$from&vrijemeDo=$to";


        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        header('Content-Type: application/json');
        if ($response === false || $httpCode !== 200) 
        {
            http_response_code(502);
            echo json_encode(['error' => 'Failed to fetch data from external API.']);
            exit;
        }

        
        echo $response;
        exit;
    }
}
?>