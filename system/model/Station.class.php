<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Station extends AbstractModel {

    public function create($name) 
    {
        $stmt = $this->db->prepare("INSERT INTO stations (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();
        return $insertId;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM stations WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $station = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $station;
    }

    public function update($id, $name) 
    {
        $stmt = $this->db->prepare("UPDATE stations SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function delete($id) 
    {
        if (!$id) return false;
        $stmt = $this->db->prepare("DELETE FROM stations WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM stations");
        $stmt->execute();
        $result = $stmt->get_result();
        $stations = [];
        if (!$result) 
        {
            return $stations; 
        }
        while ($row = $result->fetch_assoc()) 
        {
            $stations[] = $row;
        }
        $result->free();
        $stmt->close();
        return $stations;
    }
}
?>
