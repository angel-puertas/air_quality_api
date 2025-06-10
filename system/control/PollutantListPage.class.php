<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantListPage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $model = new Pollutant($this->db);
        $this->data = ['pollutants' => $model->getAll()];

    }
}
?>
