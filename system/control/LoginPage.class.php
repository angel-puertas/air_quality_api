<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    public function execute() 
    {   
        session_start();
        if (isset($_SESSION['user_id'])) {
            $this->data = ['error' => 'You are already logged in.'];
            $this->jsonResponse();
        }

        $username = $_GET['username'] ?? null;
        $password = $_GET['password'] ?? null;

        if ($username && $password) {
            $userModel = new User($this->db);
            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $this->data = [
                    'success' => true,
                    'message' => 'Login successful'
                ];
            } else {
                $this->data = [
                    'success' => false,
                    'error' => 'Invalid username or password'
                ];
            }
            $this->jsonResponse();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->data = ['error' => 'Method Not Allowed'];
            http_response_code(405);
            $this->jsonResponse();
        }

        // Handle JSON API request
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = strpos($contentType, 'application/json') !== false;
        $formData = $isJsonRequest
            ? json_decode(file_get_contents("php://input"), true)
            : $_POST;

        $username = trim($formData['username'] ?? '');
        $password = $formData['password'] ?? '';

        $userModel = new User($this->db);
        $user = $userModel->getByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $this->data = [
                'success' => true,
                'message' => 'Login successful'
            ];
        } else {
            $this->data = [
                'success' => false,
                'error' => 'Invalid username or password'
            ];
        }
        $this->jsonResponse();
    }

    private function jsonResponse() {
        header('Content-Type: application/json');
        echo json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}