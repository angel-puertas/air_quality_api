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
        if (!$name)
        {
            $this->data = ['success' => false, 'message' => 'Missing pollutant name'];
            return;
        }

        $id = $model->create($name);
        if (!$id)
        {
            $this->data = ['success' => false, 'message' => 'Pollutant creation failed'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Pollutant created!', 'pollutant' => ['id' => $id, 'name' => $name]];
    }
}
?>