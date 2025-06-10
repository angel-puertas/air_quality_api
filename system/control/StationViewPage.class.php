<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationViewPage extends AbstractPage 
{
    public function execute() 
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') 
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be GET'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $model = new Station($this->db);
        $id = $_GET['id'] ?? null;
        $station = $model->getById($id);

        if ($station === null) 
        {
            http_response_code(404); // Not Found
            echo json_encode(['success' => false, 'message' => 'Station not found'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
        
        echo json_encode($station, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
?>
