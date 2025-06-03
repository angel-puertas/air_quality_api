<?php
class AppCore {
    protected static $dbObj = null;

    function __construct() {
        $this->initDB();

        require_once('util/RequestHandler.class.php');
        RequestHandler::handle();
    }

    function initDB() {
        $dbHost = $dbUser = $dbPassword = $dbName = '';
        require_once('config.inc.php');

        require_once('model/MySQLiDatabase.class.php');
        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);
    }

    public static final function getDB() {
        return self::$dbObj;
    }

    public static function handleException($e) {
        echo "<h2>Uncaught Exception:</h2>";
        echo "<b>Message:</b> " . $e->getMessage() . "<br>";
        echo "<b>File:</b> " . $e->getFile() . "<br>";
        echo "<b>Line:</b> " . $e->getLine() . "<br>";
        echo "<b>Stack trace:</b><pre>" . $e->getTraceAsString() . "</pre>";
    }
}
?>