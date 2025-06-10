<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Measurement.class.php');
require_once('system/AppCore.class.php');
require_once('system/model/Station.class.php');
require_once('system/model/Pollutant.class.php');

class ApiPage extends AbstractPage 
{
    protected $templateName = '';

    public function execute() 
    {
        // Get station from GET parameter
        $stationId = $_GET['station_id'] ?? null;

        // Validate station parameter
        if (!$stationId) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'station_id is required parameter'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        if (!ctype_digit($stationId)) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'station_id must be a number'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        // Get station and all pollutants
        $stationModel = new Station($this->db);
        $pollutantModel = new Pollutant($this->db);

        $station = $stationModel->getById($stationId);
        $pollutants = $pollutantModel->getAll();

        if (!$station) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Station not found'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        // Define date range (e.g., last 24 hours)
        $from = date('d.m.Y', strtotime('-1 day'));
        $to = date('d.m.Y');

        // For each pollutant
        foreach ($pollutants as $pollutant) {
            // Construct API URL
            $apiUrl = "https://iszz.azo.hr/iskzl/rs/podatak/export/json?postaja=$stationId&polutant={$pollutant['id']}&tipPodatka=0" .
                "&vrijemeOd=$from&vrijemeDo=$to";

            // Fetch and store data
            try {
                $this->fetchAndStoreData($apiUrl, $stationId, $pollutant['id']);
            } catch (Exception $e) {
                error_log("Failed to fetch data for station $stationId, pollutant {$pollutant['id']}: " . $e->getMessage());
                // Continue with next pollutant even if one fails
                continue;
            }
        }

        // Return success message
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Data collection completed for station ' . $stationId], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    private function fetchAndStoreData($url, $stationId, $pollutantId)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($response === false || $httpCode !== 200) {
            throw new \Exception("Failed to fetch data for station $stationId, pollutant $pollutantId");
        }

        $data = json_decode($response, true);
        if (!is_array($data)) {
            throw new \Exception("Invalid data format for station $stationId, pollutant $pollutantId");
        }

        if (empty($data)) {
            throw new \Exception("No measurements received for station $stationId, pollututant $pollutantId");
        }

        $measurementModel = new Measurement($this->db);
        $measurementsStored = 0;

        foreach ($data as $item) {
            $value = $item['vrijednost'] ?? null;
            $unit = $item['mjernaJedinica'] ?? '';
            $time = $item['vrijeme'] ?? '';

            // Convert milliseconds to date
            if ($time !== '') {
                $time = date('Y-m-d H:i:s', $time/1000); // Convert from milliseconds to seconds
            }

            if ($value !== null && $time !== '') {
                try {
                    $measurementModel->create($stationId, $pollutantId, $value, $unit, $time);
                    $measurementsStored++;
                } catch (Exception $e) {
                    error_log("Failed to store measurement: " . $e->getMessage());
                }
            }
        }

        if ($measurementsStored === 0) {
            throw new \Exception("No measurements were stored for station $stationId, pollututant $pollutantId");
        }
    }
}
?>