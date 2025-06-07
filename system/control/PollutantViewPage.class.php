<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantViewPage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Pollutant();
        $id = $_GET['id'] ?? null;
        $this->data = $model->getById($id);
    }
}
?>
