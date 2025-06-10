<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Pollutant extends AbstractModel 
{

    public function create($name) 
    {
        $stmt = $this->db->prepare("INSERT INTO pollutants (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();
        return $insertId;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM pollutants WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pollutant = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $pollutant;
    }

    public function update($id, $name) 
    {
        $stmt = $this->db->prepare("UPDATE pollutants SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function delete($id)
    {
        if (!$id) return false;
        $stmt = $this->db->prepare("DELETE FROM pollutants WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM pollutants");
        $stmt->execute();
        $result = $stmt->get_result();
        $pollutants = [];
        if (!$result) 
        {
            return $pollutants; 
        }
        while ($row = $result->fetch_assoc()) 
        {
            $pollutants[] = $row;
        }
        $result->free();
        $stmt->close();
        return $pollutants;
    }
}
?>
