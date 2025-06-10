<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantDeletePage extends AbstractPage 
{
    protected $templateName = 'json';
    public function execute() 
    {
        $this->requireAuth(); 

        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
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
        else 
        {
            $this->data = ['error' => 'Invalid request method'];
        }

        // header('Content-Type: application/json');
        // echo json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // exit;
    }
}
?>
