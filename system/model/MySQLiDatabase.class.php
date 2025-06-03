<?php
class MySQLiDatabase {
    public $MySQLi;
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    
    public function __construct ($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    protected function connect() {
        $this->MySQLi = new MySQLi($this->host, $this->user, $this->password, $this->database);
    }

    public function sendQuery($query) {
        return $this->MySQLi->query($query);
    }

    public function fetchARray($result = null) {
        return $result->fetch_array();
    }
}
?>