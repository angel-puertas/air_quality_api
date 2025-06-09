<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class LogoutPage extends AbstractPage
{
    protected $templateName = 'logout';

    public function execute()
    {
        session_start();
        session_unset();
        session_destroy();
        $this->data = ['message' => 'You have been logged out.'];
    }
}