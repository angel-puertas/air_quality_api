<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class User extends AbstractModel 
{

    public function create($username, $password) 
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->db->execute($stmt, "ss", [$username, $hash]);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByUsername($username) 
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $this->db->execute($stmt, "s", [$username]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $username, $password) 
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->db->execute($stmt, "ssi", [$username, $hash, $id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $this->db->execute($stmt);
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
        return $users;
    }
}
?>
