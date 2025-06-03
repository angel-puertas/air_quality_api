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
}
?>