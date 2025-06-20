<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/Pollutant.class.php');

class PollutantDeletePage extends AbstractPage 
{
    public function execute() 
    {
        header('Content-Type: application/json');

        $this->requireAuth(); 

        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') 
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be DELETE'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $model = new Pollutant($this->db);

        $id = $_GET['id'] ?? null;
        if (!$id) 
        {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Missing pollutant ID'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $ok = $model->delete($id);
        if ($ok) 
        {
            echo json_encode(['success' => true, 'message' => 'Pollutant is deleted!', 'data' => ['id' => $id, 'name' => $name]], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } 
        else 
        {
            echo json_encode(['success' => false, 'message' => 'There is no pollutant with this ID'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        exit;
    }
}
?>
