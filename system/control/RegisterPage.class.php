<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class RegisterPage extends AbstractPage 
{   
    public function execute() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be POST'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        // Get JSON input
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        // Check if the user is already logged in
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'You are already logged in.']);
            return;
        }

        $username = $input['username'] ?? null;
        $password = $input['password'] ?? null;
        $confirmPassword = $input['confirm_password'] ?? null;

        if ($username && $password && $confirmPassword) {
            // Validate input
            $errors = $this->validateRegistrationInput($username, $password, $confirmPassword);

            // Check if username already exists
            $userModel = new User($this->db);
            if ($userModel->getByUsername($username)) {
                $errors['username'] = 'Username already exists';
            }

            if (!empty($errors)) {
                echo json_encode(['success' => false, 'errors' => $errors]);
                return;
            }

            $userId = $userModel->create($username, $password);

            if ($userId) {
                echo json_encode(['success' => true, 'message' => 'Registration successful!', 'data' => ['id' => $userId, 'username' => $username]], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                return;
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed']);
                return;
            }
            return;
        }
        exit;
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