<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationUpdatePage extends AbstractPage 
{
    protected $templateName = 'station_update';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        $id = $_GET['id'] ?? null;
        $name = $_GET['name'] ?? null;

        if ($id && $name) {
            $ok = $model->update($id, $name);
            if ($ok) 
            {
                $this->data = ['success' => true, 'message' => 'Station updated!'];
            } 
            else 
            {
                $this->data = ['success' => false, 'message' => 'There is no station with this ID'];
            }
        } 
        else 
        {
            $this->data = ['success' => false, 'message' => 'Missing id or name'];
        }
    }
}
?>
