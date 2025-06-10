<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationListPage extends AbstractPage 
{
    public function execute() 
    {
        header('Content-Type: application/json');

        $model = new Station($this->db);
        echo json_encode($model->getAll(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
?>