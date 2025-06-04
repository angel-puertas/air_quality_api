<?php
require_once(__DIR__ . '/../AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationDeletePage extends AbstractPage 
{
    public function execute() 
    {
        //$this->requireAuth();
        $db = AppCore::getDB();
        $model = new Station($db);
        $id = $_GET['id'] ?? null;
        $ok = $model->delete($id);
        $this->data = ['success' => $ok];
    }
}
?>
