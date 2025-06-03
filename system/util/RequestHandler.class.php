<?php
class RequestHandler {
    public function __construct($className) {
        $className = $className . 'Page';
        require_once('controller/' . $className . '.class.php');
    }

    public static function handle() {
        $request = $_GET['page'] ?? 'Index';
        new RequestHandler($request);
    }
}
?>