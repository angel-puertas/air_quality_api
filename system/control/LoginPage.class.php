<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class LoginPage extends AbstractPage 
{
    public function execute() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            http_response_code(405);
            $this->data = ['error' => 'Method Not Allowed'];
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        if (!$username || !$password) 
        {
            http_response_code(400);
            $this->data = ['error' => 'Username and password are required'];
            return;
        }

        $db = AppCore::getDB();
        $userModel = new User($db);
        $user = $userModel->getByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) 
        {
            http_response_code(401);
            $this->data = ['error' => 'Invalid credentials'];
            return;
        }

        // Successful login
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $this->data = [
            'success' => true,
            'user_id' => $user['id'],
            'message' => 'Login successful'
        ];
    }
}
?>
