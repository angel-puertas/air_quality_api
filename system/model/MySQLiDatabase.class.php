<?php
class MySQLiDatabase {
    public $MySQLi;
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $queryCount;
    protected $charset;

    protected $result;
    
    public function __construct ($host, $user, $password, $database, $charset = 'utf8') {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;

        $this->connect();
    }

    protected function connect() {
        $this->MySQLi = new MySQLi($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            throw new DatabaseException("Connecting to MySQL server '" . $this->host . "' failed", $this);
        }
    }

    protected function selectDatabase() {
        if ($this->MySQLi->select_db($this->database) === false) {
            throw new DatabaseException("Cannot select database '" . $this->database, $this);
        }
    }

    public function createDatabase() {
        try {
            $this->selectDatabase();
        }
        catch (DatabaseException $e) {
            try {
                $this->sendQuery("CREATE DATABASE IF NOT EXISTS `" . $this->database . "`");
            }
            catch (DatabaseException $e2) {
                throw new DatabaseException("Cannot create database " . $this->database, $this);
            }
        }
    }

    public function sendQuery($query, $errorReporting = true) {
        $this->queryCount++;
        $this->result = $this->MySQLi->query($query);
        if ($this->result === false && $errorReporting === true) {
            throw new DatabaseException("Invalid SQL query: " . $query, $this);
        }

        return $this->result;
    }
}
?>