<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Station.class.php');

class StationUpdatePage extends AbstractPage 
{
    public function execute() 
    {
        //$this->requireAuth();
        $model = new Station();
        $input = json_decode(file_get_contents("php://input"), true);
        $id = $_GET['id'] ?? null;
        $ok = $model->update($id, $input['name']);
        $this->data = ['success' => $ok];
    }
}
?>
