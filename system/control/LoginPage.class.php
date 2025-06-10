<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    public function execute() 
    {
        // Check if user is already logged in
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'You are already logged in.'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            http_response_code(400); // Bad Request
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $username = $input['username'] ?? null;
        $password = $input['password'] ?? null;

        if (!$username || !$password) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Missing username or password'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        $userModel = new User($this->db);
        $user = $userModel->getByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Login successful'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid username or password'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        exit;
    }
}