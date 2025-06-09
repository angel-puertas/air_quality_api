<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class RegisterPage extends AbstractPage 
{
    protected $templateName = 'register';
    
    public function execute() {       
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->showRegisterForm();
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->data = ['error' => 'Method Not Allowed'];
            return;
        }

        // Handle form submission or JSON API request
        header('Content-Type: application/json');
        $this->handleRegistration();
    }
    
    private function showRegisterForm($errors = [], $values = []) {
        $this->data = [
            'title' => 'Register',
            'method' => 'POST',
            'action' => $_SERVER['REQUEST_URI'],
            'submit_text' => 'Create Account',
            'fields' => [
                [
                    'name' => 'username',
                    'label' => 'Username',
                    'type' => 'text',
                    'required' => true,
                    'value' => $values['username'] ?? '',
                    'error' => $errors['username'] ?? null
                ],
                [
                    'name' => 'password',
                    'label' => 'Password',
                    'type' => 'password',
                    'required' => true,
                    'error' => $errors['password'] ?? null
                ],
                [
                    'name' => 'confirm_password',
                    'label' => 'Confirm Password',
                    'type' => 'password',
                    'required' => true,
                    'error' => $errors['confirm_password'] ?? null
                ]
            ]
        ];
        
        if (isset($errors['general'])) {
            $this->data['general_error'] = $errors['general'];
        }
    }
    
    private function handleRegistration() {
        // Check if it's JSON request (API) or form submission
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = strpos($contentType, 'application/json') !== false;
        
        if ($isJsonRequest) {
            // Handle JSON API request
            $input = json_decode(file_get_contents("php://input"), true);
            $formData = $input;
        } else {
            // Handle form submission
            $formData = $_POST;
        }

        // Extract form data
        $username = trim($formData['username'] ?? '');
        $password = $formData['password'] ?? '';
        $confirmPassword = $formData['confirm_password'] ?? '';

        // Validate input
        $errors = $this->validateRegistrationInput($username, $password, $confirmPassword);
        
        if (!empty($errors)) {
            if ($isJsonRequest) {
                http_response_code(400);
                $this->data = ['errors' => $errors];
                return;
            } else {
                $this->showRegisterForm($errors, $formData);
                return;
            }
        }

        // Check if user already exists
        $userModel = new User($this->db);
        if ($userModel->getByUsername($username)) {
            $errors['username'] = 'Username already exists';
            if ($isJsonRequest) {
                http_response_code(409);
                $this->data = ['errors' => $errors];
                return;
            } else {
                $this->showRegisterForm($errors, $formData);
                return;
            }
        }

        $userId = $userModel->create($username, $password);

        if ($userId) {
            if ($isJsonRequest) {
                http_response_code(201);
                $this->data = [
                    'success' => true,
                    'user_id' => $userId,
                    'message' => 'Registration successful'
                ];
            } else {
                // Auto-login after registration
                session_start();
                $_SESSION['user_id'] = $userId;
                header('Location: index.php');
                exit;
            }
        } else {
            if ($isJsonRequest) {
                http_response_code(500);
                $this->data = ['error' => 'Registration failed'];
            } else {
                $errors['general'] = 'Registration failed. Please try again.';
                $this->showRegisterForm($errors, $formData);
            }
        }
    }
    
    private function validateRegistrationInput($username, $password, $confirmPassword) {
        $errors = [];
        
        // Username validation
        if (empty($username)) {
            $errors['username'] = 'Username is required';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username must be at least 3 characters';
        }
        
        // Password validation
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        
        // Confirm password validation
        if (empty($confirmPassword)) {
            $errors['confirm_password'] = 'Please confirm your password';
        } elseif ($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
        
        return $errors;
    }
}
?>