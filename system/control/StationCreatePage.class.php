<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationCreatePage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Station($this->db);
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents("php://input"), true);
        $id = $model->create($input['name']);
        $this->data = ['success' => true, 'id' => $id];
    }
}
?>
