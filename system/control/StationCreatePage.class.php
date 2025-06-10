<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationCreatePage extends AbstractPage 
{
    protected $templateName = 'station_create';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        $name = $_GET['name'] ?? null;

        if ($name) 
        {
            $id = $model->create($name);
            $this->data = ['success' => true, 'id' => $id, 'message' => 'Station created!'];
        } 
        else 
        {
            $this->data = ['success' => false, 'message' => 'Missing station name'];
        }
    }
}
?>
