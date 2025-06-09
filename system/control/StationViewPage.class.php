<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationViewPage extends AbstractPage 
{
    protected $templateName = 'station_view';
    public function execute() 
    {
        $model = new Station($this->db);
        $id = $_GET['id'] ?? null;
        $this->data = $model->getById($id);
    }
}
?>
