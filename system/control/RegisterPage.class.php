<?php
require_once(__DIR__ . '/AbstractPage.class.php');
require_once('system/model/User.class.php');

class RegisterPage extends AbstractPage 
{
    public function execute() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->data = ['error' => 'Method Not Allowed'];
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        if (!$username || !$password) {
            http_response_code(400);
            $this->data = ['error' => 'Username and password are required'];
            return;
        }

        $userModel = new User();

        // Check if user already exists
        if ($userModel->getByUsername($username)) {
            http_response_code(409);
            $this->data = ['error' => 'Username already exists'];
            return;
        }

        // Create user
        $userId = $userModel->create($username, $password);

        // Optional: auto-login after registration
        session_start();
        $_SESSION['user_id'] = $userId;

        $this->data = 
        [
            'success' => true,
            'user_id' => $userId,
            'message' => 'Registration successful'
        ];
    }
}
?>
