<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationDeletePage extends AbstractPage 
{
    protected $templateName = 'station_delete';
    public function execute() 
    {
        $this->requireAuth(); 
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $model = new Station($this->db);
            $id = $_GET['id'] ?? null;
            $ok = $model->delete($id);
            if ($ok) 
            {
                $this->data = ['success' => true, 'message' => 'Station is deleted!'];
            } 
            else 
            {
                $this->data = ['success' => false, 'message' => 'There is no station with this ID'];
            }
        } 
        else 
        {
            $this->data = ['error' => 'Invalid request method'];
        }
    }
}
?>
