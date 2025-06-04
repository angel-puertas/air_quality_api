<?php
require_once(__DIR__ . '/../AbstractPage.class.php');
require_once('system/model/Measurement.class.php');

class MeasurementListPage extends AbstractPage 
{
    public function execute() 
    {
        //$this->requireAuth();
        $db = AppCore::getDB();
        $model = new Measurement($db);

        if (isset($_GET['station_id']) && isset($_GET['pollutant_id'])) 
        {
            $this->data = $model->getByStationAndPollutant($_GET['station_id'], $_GET['pollutant_id']);
        } 
        elseif (isset($_GET['id'])) 
        {
            $this->data = $model->getById($_GET['id']);
        } 
        else 
        {
            $this->data = $model->getAll();
        }
    }
}
?>
