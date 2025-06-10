<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantViewPage extends AbstractPage 
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
        
        $model = new Pollutant($this->db);
        $id = $_GET['id'] ?? null;
        $pollutant = $model->getById($id); // this is null if theres no pollutant
        
        if ($pollutant === null) 
        {
            http_response_code(404); // Not Found
            echo json_encode(['success' => false, 'message' => 'Pollutant not found'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        echo json_encode($pollutant, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>
