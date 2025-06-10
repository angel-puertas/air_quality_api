<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    protected $templateName = 'login';

    public function execute() 
    {   
        session_start();
        if (isset($_SESSION['user_id'])) 
        {
            $this->data['general_error'] = 'You are already logged in.';
            return;
        }
        $username = $_GET['username'] ?? null;
        $password = $_GET['password'] ?? null;

        if ($username && $password) {
            $userModel = new User($this->db);
            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) 
            {
                $_SESSION['user_id'] = $user['id'];
                $this->data = 
                [
                    'success' => true,
                    'message' => 'Login successful',
                    //header('Location: index.php'), 
                ];
            } 
            else 
            {
                $this->data = 
                [
                    'success' => false,
                    'error' => 'Invalid username or password'
                ];
            }
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') 
        {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->data = ['error' => 'Method Not Allowed'];
            return;
        }

        header('Content-Type: application/json');
        $this->handleLogin();
    }

    private function handleLogin() 
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = strpos($contentType, 'application/json') !== false;

        if ($isJsonRequest) {
            $input = json_decode(file_get_contents("php://input"), true);
            $formData = $input;
        } else {
            $formData = $_POST;
        }

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
    }
}