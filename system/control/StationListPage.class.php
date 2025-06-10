<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationListPage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        //echo "StationListPage reached!"; //for testing purposes
        $model = new Station($this->db);
        $this->data = ['stations' => $model->getAll()];
    
        // header('Content-Type: application/json');
        // echo json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // exit;
    }
}

$page = new StationListPage();
?>
