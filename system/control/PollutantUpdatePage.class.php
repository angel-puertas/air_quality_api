<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantUpdatePage extends AbstractPage 
{
    public function execute() 
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be PUT'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $model = new Pollutant($this->db);

        $id = $input['id'] ?? null;
        $name = $input['name'] ?? null;

        if ($id && $name) {
            $ok = $model->update($id, $name);
            if ($ok) {
                echo json_encode(['success' => true, 'message' => 'Pollutant updated!'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                echo json_encode(['success' => false, 'message' => 'There is no pollutant with this ID'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing id or name'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        exit;
    }
}
?>
