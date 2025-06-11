<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationCreatePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        $name = $_GET['name'] ?? null;
        if (!$name)
        {
            $this->data = ['success' => false, 'message' => 'Missing station name'];
            return;
        }

        $id = $model->create($name);
        if (!$id)
        {
            $this->data = ['success' => false, 'message' => 'Station creation failed'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Station created', 'station' => ['id' => $id, 'name' => $name]];
    }
}
?>
