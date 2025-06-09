<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class User extends AbstractModel 
{

    public function create($username, $password) 
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $username, $hash);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();
        return $insertId;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $user;
    }

    public function getByUsername($username) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $user;
    }

    public function update($id, $username, $password) 
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssi", $username, $hash, $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        if (!$result) 
        {
            return $users; //empty array
        }
        while ($row = $result->fetch_assoc()) 
        {
            $users[] = $row;
        }
        $result->free();
        $stmt->close();
        return $users;
    }
}
?>
