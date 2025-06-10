<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class LogoutPage extends AbstractPage
{
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Method must be POST'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        session_start();
        session_unset();
        session_destroy();

        echo json_encode(['success' => true, 'message' => 'You have been logged out.'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}