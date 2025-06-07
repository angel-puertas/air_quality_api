<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationViewPage extends AbstractPage 
{
    public function execute() 
    {
        $db = AppCore::getDB();
        $model = new Station($db);
        $id = $_GET['id'] ?? null;
        $this->data = $model->getById($id);
    }
}
?>
