<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantDeletePage extends AbstractPage 
{
    protected $templateName = 'pollutant_delete';
    public function execute() 
    {
        $model = new Pollutant($this->db);
        $id = $_GET['id'] ?? null;
        $ok = $model->delete($id);
        if ($ok) 
        {
            $this->data = ['success' => true, 'message' => 'Pollutant is deleted!'];
        } 
        else 
        {
            $this->data = ['success' => false, 'message' => 'There is no pollutant with this ID'];
        }
    }
}
?>
