<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantViewPage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $model = new Pollutant($this->db);
        
        $id = $_GET['id'] ?? null;
        if (!$id) 
        {
            $this->data = ['success' => false, 'message' => 'Missing pollutant ID'];
            return;
        }

        $pollutant =  $model->getById($id);
        if (!$pollutant)
        {
            $this->data = ['success' => false, 'message' => 'There is no pollutant with this ID'];
            return;
        }

        $this->data = $pollutant;
    }
}
?>
