
<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Pollutant extends AbstractModel 
{

    public function create($name) 
    {
        $stmt = $this->db->prepare("INSERT INTO pollutants (name) VALUES (?)");
        $this->db->execute($stmt, "s", [$name]);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM pollutants WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $name) 
    {
        $stmt = $this->db->prepare("UPDATE pollutants SET name = ? WHERE id = ?");
        $this->db->execute($stmt, "si", [$name, $id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pollutants WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM pollutants");
        $this->db->execute($stmt);
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
        return $pollutants;
    }
}
?>
