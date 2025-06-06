<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantListPage extends AbstractPage 
{
    public function execute() 
    {
        $this->requireAuth();
        $db = AppCore::getDB();
        $model = new Pollutant($db);
        $this->data = $model->getAll();
    }
}
?>
