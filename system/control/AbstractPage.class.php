<?php
abstract class AbstractPage {
    protected $data = [];
    protected $templateName = ''; 

    public function __construct() 
    {
        //$this->requireAuth(); 
        // this cannot be called here because it will block the login and register page
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