<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationListPage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $model = new Station($this->db);
        $this->data = $model->getAll();
    }
}
?>