<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Measurement.class.php');

class MeasurementListPage extends AbstractPage 
{
    public function execute()
    {
        header('Content-Type: application/json');

        $model = new Measurement($this->db);

        if (isset($_GET['fake'])) 
        {
            echo json_encode($model->fakeStation(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        elseif (isset($_GET['station_id']) && isset($_GET['pollutant_id'])) 
        {
            echo json_encode($model->getByStationAndPollutant($_GET['station_id'], $_GET['pollutant_id']), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } 
        elseif (isset($_GET['station_id'])) 
        {
            echo json_encode($model->getByStation($_GET['station_id']), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } 
        elseif (isset($_GET['id'])) 
        {
            echo json_encode($model->getById($_GET['id']), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } 
        else 
        {
            echo json_encode($model->getAll(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

        exit;
    }
}
?>