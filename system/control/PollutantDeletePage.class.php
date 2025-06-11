<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantDeletePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Pollutant($this->db);

        $id = $_GET['id'] ?? null;
        if (!$id)
        {
            $this->data = ['success' => false, 'message' => 'Missing id'];
            return;
        }

        // To return deleted pollutant
        $pollutant = $model->getById($id);
        if (!$pollutant)
        {
            $this->data = ['success' => false, 'message' => 'There is no pollutant with this ID'];
            return;
        }

        $ok = $model->delete($id);
        if (!$ok) 
        {
            $this->data = ['success' => false, 'message' => 'Pollutant deletion failed'];
            return;
        }

        $this->data = ['success' => true, 'message' => 'Pollutant deleted', 'pollutant' => $pollutant];
    }
}
?>
