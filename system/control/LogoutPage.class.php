<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class LogoutPage extends AbstractPage
{
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Method must be POST'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        session_start();
        session_unset();
        session_destroy();

        header('Content-Type: application/json');
        echo json_encode(['message' => 'You have been logged out.'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}