<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantUpdatePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Pollutant($this->db);

        $id = $_GET['id'] ?? null;
        $name = $_GET['name'] ?? null;
        if (!$id || !$name)
        {
            $this->data = ['success' => false, 'message' => 'Missing id or name'];
            return;
        }

        $ok = $model->update($id, $name);
        if (!$ok) 
        {
            $this->data = ['success' => false, 'message' => 'There is no pollutant with this ID'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Pollutant updated', 'pollutant' => ['id' => $id, 'name' => $name]];
    }
}
?>
