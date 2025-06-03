<?php
class RequestHandler {
    public function __construct($className) {
        $className = $className.'Page';
        $classPath = 'system/control/' . $className . '.class.php';

        if (!preg_match('/^[a-z0-9_]+$/i', $className) || !file_exists($classPath)) {
            throw new IllegalLinkException();
        }

        require_once($classPath);

        if (!class_exists($className)) {
            throw new SystemException("Class '" . $className . "' not found");
        }

        new $className();
    }

    public static function handle() {
        if (!empty($_GET['page']) || !empty($_POST['page'])) {
            new RequestHandler((!empty($_GET['page']) ? $_GET['page'] : $_POST['page']));
        } else {
            new RequestHandler('Index');
        }
    }
}
?>