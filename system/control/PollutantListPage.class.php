<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantListPage extends AbstractPage 
{
    public function execute() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Method must be GET'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $model = new Pollutant($this->db);
        $pollutants = $model->getAll();

        header('Content-Type: application/json');
        echo json_encode($pollutants, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
?>
