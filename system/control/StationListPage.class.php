<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationListPage extends AbstractPage 
{
    protected $templateName = 'station_list';
    public function execute() 
    {
        //echo "StationListPage reached!"; //for testing purposes
        $model = new Station();
        $this->data = ['stations' => $model->getAll()];
    }
}

$page = new StationListPage();
?>
