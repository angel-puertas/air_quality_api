<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationDeletePage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Station($this->db);
        $id = $_GET['id'] ?? null;
        $ok = $model->delete($id);
        $this->data = ['success' => $ok];
    }
}
?>
