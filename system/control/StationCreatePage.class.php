<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationCreatePage extends AbstractPage 
{
    protected $templateName = 'station_create';
    public function execute() 
    {
        $this->requireAuth();
        $model = new Station($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $input = json_decode(file_get_contents("php://input"), true);
            if (isset($input['name'])) {
                $id = $model->create($input['name']);
                $this->data = ['success' => true, 'id' => $id];
            } else {
                $this->data = ['error' => 'Missing station name'];
            }
            echo json_encode($this->data);
            exit;
        }
    }
}
?>
