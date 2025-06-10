<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class RegisterPage extends AbstractPage 
{
    public function execute() {   
        session_start();
        if (isset($_SESSION['user_id'])) {
            $this->data = ['error' => 'You are already logged in.'];
            $this->jsonResponse();
        }

        $username = $_GET['username'] ?? null;
        $password = $_GET['password'] ?? null;
        $confirmPassword = $_GET['confirm_password'] ?? null;

        if ($username && $password && $confirmPassword) {
            $errors = $this->validateRegistrationInput($username, $password, $confirmPassword);

            $userModel = new User($this->db);
            if ($userModel->getByUsername($username)) {
                $errors['username'] = 'Username already exists';
            }

            if (!empty($errors)) {
                $this->data = ['success' => false, 'errors' => $errors];
                $this->jsonResponse();
            }

            $userId = $userModel->create($username, $password);

            if ($userId) {
                $this->data = [
                    'success' => true,
                    'user_id' => $userId,
                    'message' => 'Registration successful'
                ];
            } else {
                $this->data = ['success' => false, 'message' => 'Registration failed'];
            }
            $this->jsonResponse();
        }

        // Only allow GET with params or POST (JSON)
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
        $confirmPassword = $formData['confirm_password'] ?? '';

        $errors = $this->validateRegistrationInput($username, $password, $confirmPassword);

        $userModel = new User($this->db);
        if ($userModel->getByUsername($username)) {
            $errors['username'] = 'Username already exists';
        }

        if (!empty($errors)) {
            http_response_code(400);
            $this->data = ['success' => false, 'errors' => $errors];
            $this->jsonResponse();
        }

        $userId = $userModel->create($username, $password);

        if ($userId) {
            $this->data = [
                'success' => true,
                'user_id' => $userId,
                'message' => 'Registration successful'
            ];
        } else {
            $this->data = ['success' => false, 'message' => 'Registration failed'];
        }
        $this->jsonResponse();
    }

    private function validateRegistrationInput($username, $password, $confirmPassword) {
        $errors = [];
        if (empty($username)) {
            $errors['username'] = 'Username is required';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username must be at least 3 characters';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        if (empty($confirmPassword)) {
            $errors['confirm_password'] = 'Please confirm your password';
        } elseif ($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
        return $errors;
    }

    private function jsonResponse() {
        header('Content-Type: application/json');
        echo json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}