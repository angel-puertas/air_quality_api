<?php
abstract class AbstractPage {
    protected $data = [];
    protected $db;
    protected $templateName;

    public function __construct() 
    {
        $this->db = AppCore::getDB();
        header('Content-Type: application/json');
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
            echo json_encode(['success' => false, 'message' => 'Unauthorized'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    }
}
?>