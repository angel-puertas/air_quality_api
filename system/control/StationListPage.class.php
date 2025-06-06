<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationListPage extends AbstractPage 
{
    public function execute() 
    {
        echo "StationListPage reached!"; //for testing purposes
        //$this->requireAuth();
        $db = AppCore::getDB();
        $model = new Station($db);
        $this->data = $model->getAll();
    }
}
?>
