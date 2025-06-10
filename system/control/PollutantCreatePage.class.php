<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantCreatePage extends AbstractPage 
{
    public function execute() 
    {
        header('Content-Type: application/json');

        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be POST'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $model = new Pollutant($this->db);

        $name = $input['name'] ?? null;

        if ($name) {
            $id = $model->create($name);
            echo json_encode(['success' => true, 'message' => 'Pollutant created!', 'data' => ['id' => $id, 'name' => $name]], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing pollutant name'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        exit;
    }
}