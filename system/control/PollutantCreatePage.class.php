<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantCreatePage extends AbstractPage 
{
    public function execute() 
    {
        $model = new Pollutant();
        $input = json_decode(file_get_contents("php://input"), true);
        $id = $model->create($input['name']);
        $this->data = ['success' => true, 'id' => $id];
    }
}
?>
