<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantUpdatePage extends AbstractPage 
{
    protected $templateName = 'pollutant_update';
    public function execute() 
    {
        // $this->requireAuth();
        $model = new Pollutant($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') 
        {
            header('Content-Type: application/json');
            $input = json_decode(file_get_contents("php://input"), true);
            $id = $_GET['id'] ?? null;
            if ($id && isset($input['name'])) {
                $ok = $model->update($id, $input['name']);
                if ($ok) {
                    $this->data = ['success' => true];
                } else {
                    $this->data = ['error' => 'There is no pollutant with this ID'];
                }
            } else {
                $this->data = ['error' => 'Invalid input'];
            }
            echo json_encode($this->data);
            exit;
        }
    }
}
?>
