
<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Pollutant extends AbstractModel 
{

    public function create($name) 
    {
        $name = $this->db->escape($name);
        $sql = "INSERT INTO pollutants (name) VALUES ('$name')";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $id = (int)$id;
        $sql = "SELECT * FROM pollutants WHERE id=$id";
        $result = $this->db->sendQuery($sql);
        return $result->fetch_assoc();
    }

    public function update($id, $name) 
    {
        $id = (int)$id;
        $name = $this->db->escape($name);
        $sql = "UPDATE pollutants SET name='$name' WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id)
     {
       $id = (int)$id;
        $sql = "DELETE FROM pollutants WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() 
    {
        $sql = "SELECT * FROM pollutants";
        $result = $this->db->sendQuery($sql);
        $pollutants = [];
        if (!$result) 
        {
            return $pollutants; 
        }
        while ($row = $result->fetch_assoc()) 
        {
            $pollutants[] = $row;
        }
        return $pollutants;
    }
}
?>
