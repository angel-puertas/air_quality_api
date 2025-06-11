<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationUpdatePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        $id = $_GET['id'] ?? null;
        $name = $_GET['name'] ?? null;
        if (!$id || !$name)
        {
            $this->data = ['success' => false, 'message' => 'Missing id or name'];
            return;
        }

        $ok = $model->update($id, $name);
        if (!$ok) 
        {
            $this->data = ['success' => false, 'message' => 'There is no station with this ID'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Station updated', 'station' => ['id' => $id, 'name' => $name]];
    }
}
?>
