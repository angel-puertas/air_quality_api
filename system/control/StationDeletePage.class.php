<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationDeletePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        $id = $_GET['id'] ?? null;
        if (!$id)
        {
            $this->data = ['success' => false, 'message' => 'Missing station ID'];
            return;
        }

        // To return deleted station
        $station = $model->getById($id);
        if (!$station)
        {
            $this->data = ['success' => false, 'message' => 'There is no station with this ID'];
            return;
        }

        $ok = $model->delete($id);
        if (!$ok) 
        {
            $this->data = ['success' => false, 'message' => 'There is no station with this ID'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Station deleted', 'station' => $station];
    }
}
?>
