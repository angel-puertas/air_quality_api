<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class LogoutPage extends AbstractPage
{
    protected $templateName = 'json';

    public function execute()
    {
        session_start();
        session_unset();
        session_destroy();
        $this->data = ['success' => true, 'message' => 'You have been logged out.'];
    }
}