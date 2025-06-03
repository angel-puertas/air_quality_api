<?php
class Station extends AbstractModel {

    public function create($name) 
    {
        $name = $this->db->escape($name);
        $sql = "INSERT INTO stations (name) VALUES ('$name')";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $id = (int)$id;
        $sql = "SELECT * FROM stations WHERE id=$id";
        $result = $this->db->sendQuery($sql);
        return $result->fetch_assoc();
    }

    public function update($id, $name) 
    {
        $id = (int)$id;
        $name = $this->db->escape($name);
        $sql = "UPDATE stations SET name='$name' WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id) 
    {
        $id = (int)$id;
        $sql = "DELETE FROM stations WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() 
    {
        $sql = "SELECT * FROM stations";
        $result = $this->db->sendQuery($sql);
        $stations = [];
        if (!$result) 
        {
            return $stations; 
        }
        while ($row = $result->fetch_assoc()) 
        {
            $stations[] = $row;
        }
        return $stations;
    }
}
?>
