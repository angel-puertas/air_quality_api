<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantViewPage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Pollutant($this->db);
        $id = $_GET['id'] ?? null;
        $pollutant =  $model->getById($id);
        
        header('Content-Type: application/json');
        echo json_encode($pollutant, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>
