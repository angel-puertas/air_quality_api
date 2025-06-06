<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantDeletePage extends AbstractPage 
{
    public function execute() 
    {
        $this->requireAuth();
        $db = AppCore::getDB();
        $model = new Pollutant($db);
        $id = $_GET['id'] ?? null;
        $ok = $model->delete($id);
        $this->data = ['success' => $ok];
    }
}
?>
