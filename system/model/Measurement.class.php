<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Measurement extends AbstractModel {

    public function create($station_id, $pollutant_id, $value, $unit, $time) // why no unit?? 
    {
        $stmt = $this->db->prepare("
            INSERT INTO measurements (station_id, pollutant_id, value, unit, time)
            VALUES (?, ?, ?, ?, ?)
        ");

        $this->db->execute($stmt, "iisss", [
            (int)$station_id,
            (int)$pollutant_id,
            $value,
            $unit,
            $time
        ]); 

        return $this->db->MySQLi->insert_id;
    }

    public function getByStation($station_id) //this was missing before
    {

        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE station_id = ?");
        $this->db->execute($stmt, "i", [$station_id]);
        $result = $stmt->get_result();
        $measurements = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $measurements[] = $row;
            }
        }
        return $measurements;
    }

    public function getById($id) 
    {

        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByStationAndPollutant($station_id, $pollutant_id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE station_id = ? AND pollutant_id = ?");
        $this->db->execute($stmt, "ii", [$station_id, $pollutant_id]);
        $result = $stmt->get_result();
        $measurements = [];
        while ($row = $result->fetch_assoc()) {
            $measurements[] = $row;
        }
        return $measurements;
    }

    public function update($id, $value, $unit, $time) 
    {
        $stmt = $this->db->prepare("UPDATE measurements SET value = ?, unit = ?, time = ? WHERE id = ?");
        $this->db->execute($stmt, "sssi", [$value, $unit, $time, $id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM measurements WHERE id = ?");
        $this->db->execute($stmt, "i", [$id]);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM measurements");
        $result = $stmt->get_result();
        $measurements = [];
        if (!$result) 
        {
            return $measurements; 
        }
        while ($row = $result->fetch_assoc()) 
        {
            $measurements[] = $row;
        }
        return $measurements;
    }
}
?>
