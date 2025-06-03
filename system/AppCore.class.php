<?php
class AppCore {
    protected static $dbObj = null;

    function __construct() {
        require_once('core.functions.php');

        $this->initDB();
        $this->initOptions();

        require_once('util/RequestHandler.class.php');
        RequestHandler::handle();
    }

    function handleException(Exception $e) {
        $e->show();
    }

    function initDB() {
        $dbHost = $dbUser = $dbPassword = $dbName = '';
        require_once('config.inc.php');

        require_once('model/MySQLiDatabase.class.php');
        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);
    }

    function initOptions() {
        require_once('options.inc.php');
    }

    public static final function getDB() {
        return self::$dbObj;
    }
}
?>