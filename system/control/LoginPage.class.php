<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    protected $templateName = 'json';

    public function execute() 
    {   
        session_start();
        if (isset($_SESSION['user_id'])) 
        {
            $this->data = ['success' => true, 'message' => 'You are already logged in.'];
            return;
        }

        $username = $_GET['username'] ?? null;
        $password = $_GET['password'] ?? null;
        if (!$username || !$password) 
        {
            $this->data = ['success' => false, 'message' => 'Missing username or password'];
            return;
        }

        $userModel = new User($this->db);
        $user = $userModel->getByUsername($username);
        if (!$user || !password_verify($password, $user['password'])) 
        {
            $this->data = 
            [
                'success' => false,
                'message' => 'Invalid username or password'
            ];
            return;
        } 

        $_SESSION['user_id'] = $user['id'];
        $this->data = 
        [
            'success' => true,
            'message' => 'Login successful'
        ];
        return;
    }
}