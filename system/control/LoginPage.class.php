<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    protected $templateName = 'login';
    
    public function execute() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->showLoginForm();
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->data = ['error' => 'Method Not Allowed'];
            return;
        }

        // Handle form submission or JSON API request
        $this->handleLogin();
    }
    
    private function showLoginForm($errors = []) {
        $this->data = [
            'title' => 'Login',
            'method' => 'POST',
            'action' => $_SERVER['REQUEST_URI'],
            'submit_text' => 'Login',
            'fields' => [
                [
                    'name' => 'username',
                    'label' => 'Username',
                    'type' => 'text',
                    'required' => true,
                    'error' => $errors['username'] ?? null
                ],
                [
                    'name' => 'password',
                    'label' => 'Password',
                    'type' => 'password',
                    'required' => true,
                    'error' => $errors['password'] ?? null
                ]
            ]
        ];
        
        if (isset($errors['general'])) {
            $this->data['general_error'] = $errors['general'];
        }
    }
    
    private function handleLogin() {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = strpos($contentType, 'application/json') !== false;
        
        if ($isJsonRequest) {
            $input = json_decode(file_get_contents("php://input"), true);
            $username = $input['username'] ?? '';
            $password = $input['password'] ?? '';
        } else {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
        }

        $errors = [];
        
        if (!$username || !$password) {
            if ($isJsonRequest) {
                http_response_code(400);
                $this->data = ['error' => 'Username and password are required'];
                return;
            } else {
                $errors['general'] = 'Username and password are required';
                $this->showLoginForm($errors);
                return;
            }
        }

        $userModel = new User();
        $user = $userModel->getByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            if ($isJsonRequest) {
                http_response_code(401);
                $this->data = ['error' => 'Invalid credentials'];
                return;
            } else {
                $errors['general'] = 'Invalid username or password';
                $this->showLoginForm($errors);
                return;
            }
        }

        // Successful login
        session_start();
        $_SESSION['user_id'] = $user['id'];
        
        if ($isJsonRequest) {
            $this->data = [
                'success' => true,
                'user_id' => $user['id'],
                'message' => 'Login successful'
            ];
        } else {
            header('Location: index.php');
            exit;
        }
    }
}
?>