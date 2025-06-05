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
        if ($this->MySQLi->connect_error) //just in case
        {
            throw new Exception("MySQLi connection failed: " . $this->MySQLi->connect_error);
        }
    }

    public function sendQuery($query) {
        return $this->MySQLi->query($query);
    }

    public function fetchArray($result = null) {
        return $result->fetch_array();
    }

    public function escape($value) 
    {
        return $this->MySQLi->real_escape_string($value);
    }


    public function installDatabase() {
        $this->sendQuery("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    
        $this->sendQuery("
            CREATE TABLE IF NOT EXISTS stations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )
        ");
    
        $this->sendQuery("
            CREATE TABLE IF NOT EXISTS pollutants (
                id int auto_increment primary key,
                name VARCHAR(255) not null
            )
        ");
    
        $this->sendQuery("
            CREATE TABLE IF NOT EXISTS measurements (
                id INT AUTO_INCREMENT primary key,
                station_id int not null,
                pollutant_id int not null,
                value VARCHAR(255) NOT NULL,
                unit VARCHAR(10) NOT NULL,
                time VARCHAR(13) NOT NULL,
                foreign key (station_id) REFERENCES stations(id),
                FOREIGN KEY (pollutant_id) REFERENCES pollutants(id)
            )
        ");
    }
    
}
?>