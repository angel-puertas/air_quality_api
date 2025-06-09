<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Measurement.class.php');

class MeasurementListPage extends AbstractPage 
{
    protected $templateName = 'measurement_list';
    public function execute() 
    {
        $model = new Measurement($this->db);

        if (isset($_GET['station_id']) && isset($_GET['pollutant_id'])) 
        {
            $this->data = ['measurements' => $model->getByStationAndPollutant($_GET['station_id'], $_GET['pollutant_id'])];
        } 
        elseif (isset($_GET['station_id'])) 
        {
            $this->data = ['measurements' => $model->getByStation($_GET['station_id'])];
        }
        elseif (isset($_GET['id'])) 
        {
            $this->data = ['measurement' => $model->getById($_GET['id'])];
        } 
        else 
        {
            $this->data = ['measurements' => $model->getAll()];
        }
    }
}
?>
