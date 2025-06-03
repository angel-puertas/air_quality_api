<?php
abstract class AbstractPage {
    protected $data = [];
    public $templateName = '';

    public function __construct() {
        $this->execute();
        $this->show();
    }

    public function show() {
        $template = $this->templateName;
        $data = $this->data;
        include_once('system/view/' . $template . '.tpl.php');
    }

    
    abstract public function execute();
}
?>