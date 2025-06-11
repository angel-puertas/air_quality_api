<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class RegisterPage extends AbstractPage 
{
    protected $templateName = 'json'; 

    public function execute() 
    {   
        session_start();
        if (isset($_SESSION['user_id'])) 
        {
            $this->data = ['success' => false, 'message' => 'You are already logged in.'];
            return;
        }

        $username = $_GET['username'] ?? null;
        $password = $_GET['password'] ?? null;
        $confirmPassword = $_GET['confirm_password'] ?? null;
        if (!$username || !$password || !$confirmPassword) 
        {
            $this->data = ['success' => false, 'message' => 'Missing username, password or confirm password'];
            return;
        }

        $errors = $this->validateRegistrationInput($username, $password, $confirmPassword);

        $userModel = new User($this->db);
        if ($userModel->getByUsername($username)) 
        {
            $errors['username'] = 'Username already exists';
        }

        if (!empty($errors)) 
        {
            $this->data = [
                'success' => false,
                'message' => 'Registration failed',
                'errors' => $errors
            ];
            return;
        }

        $userId = $userModel->create($username, $password);
        if (!$userId) 
        {
            $this->data = [
                'success' => false,
                'message' => 'Registration failed'
            ];
            return;
        }

        $this->data = [
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user_id' => $userId,
                'username' => $username
            ]
        ];
        return;
    }

    private function validateRegistrationInput($username, $password, $confirmPassword) 
    {
        $errors = [];
        if (empty($username)) 
        {
            $errors['username'] = 'Username is required';
        } 
        elseif (strlen($username) < 3) 
        {
            $errors['username'] = 'Username must be at least 3 characters';
        }

        if (empty($password)) 
        {
            $errors['password'] = 'Password is required';
        } 
        elseif (strlen($password) < 6) 
        {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (empty($confirmPassword)) 
        {
            $errors['confirm_password'] = 'Please confirm your password';
        } 
        elseif ($password !== $confirmPassword) 
        {
            $errors['confirm_password'] = 'Passwords do not match';
        }
        
        return $errors;
    }
}