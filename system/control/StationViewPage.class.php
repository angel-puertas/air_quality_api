<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationViewPage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Station($this->db);
        $id = $_GET['id'] ?? null;
        $station = $model->getById($id);
        header('Content-Type: application/json');
        echo json_encode($station, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>
