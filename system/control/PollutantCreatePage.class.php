<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantCreatePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Pollutant($this->db);

        $name = $_GET['name'] ?? null;

        if ($name) 
        {
            $id = $model->create($name);
            $this->data = ['success' => true, 'id' => $id, 'message' => 'Pollutant created!'];
        } 
        else 
        {
            $this->data = ['success' => false, 'message' => 'Missing pollutant name'];
        }

    }
}
?>
