<?php
abstract class AbstractPage {
    protected $data = [];
    public $templateName = '';

    public function __construct() 
    {
        $this->requireAuth(); // theoretically, we can call this in child classes, 
        // but since limitation for ALL crud operations is the same, we can call it here
        $this->execute();
        $this->show();
    }

    public function show() {
        $template = $this->templateName;
        $data = $this->data;
        include_once('system/view/' . $template . '.tpl.php');
    }

    
    abstract public function execute();

    protected function requireAuth() // Ensure that only authenticated users can do crud stuff
    {
        session_start();
        if (empty($_SESSION['user_id'])) 
        {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
}
?>