<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class User extends AbstractModel 
{

    public function create($username, $password) 
    {
        $username = $this->db->escape($username);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $id = (int)$id;
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $this->db->sendQuery($sql);
        return $result->fetch_assoc();
    }

    public function getByUsername($username) 
    {
        $username = $this->db->escape($username);
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->db->sendQuery($sql);
        return $result->fetch_assoc();
    }

    public function update($id, $username, $password) 
    {
        $id = (int)$id;
        $username = $this->db->escape($username);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', password='$hash' WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id) 
    {
        $id = (int)$id;
        $sql = "DELETE FROM users WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() 
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->sendQuery($sql);
        $users = [];
        if (!$result) 
        {
            return $users; //empty array
        }
        while ($row = $result->fetch_assoc()) 
        {
            $users[] = $row;
        }
        return $users;
    }
}
?>
