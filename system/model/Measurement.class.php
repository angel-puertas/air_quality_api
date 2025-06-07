<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Measurement extends AbstractModel {

    public function create($station_id, $pollutant_id, $value, $unit, $time) // why no unit?? 
    {
        $station_id = (int)$station_id;
        $pollutant_id = (int)$pollutant_id;
        $value = $this->db->escape($value);
        $unit = $this->db->escape($unit);
        $time = $this->db->escape($time);
        $sql = "INSERT INTO measurements (station_id, pollutant_id, value, unit, time)
                VALUES ($station_id, $pollutant_id, '$value', '$unit', '$time')";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->insert_id;
    }

    public function getById($id) 
    {
        $id = (int)$id;
        $sql = "SELECT * FROM measurements WHERE id=$id";
        $result = $this->db->sendQuery($sql);
        return $result->fetch_assoc();
    }

    public function getByStationAndPollutant($station_id, $pollutant_id) 
    {
        $station_id = (int)$station_id;
        $pollutant_id = (int)$pollutant_id;
        $sql = "SELECT * FROM measurements WHERE station_id=$station_id AND pollutant_id=$pollutant_id";
        $result = $this->db->sendQuery($sql);
        $measurements = [];
        while ($row = $result->fetch_assoc()) {
            $measurements[] = $row;
        }
        return $measurements;
    }

    public function update($id, $value, $unit, $time) 
    {
        $id = (int)$id;
        $value = $this->db->escape($value);
        $unit = $this->db->escape($unit);
        $time = $this->db->escape($time);
        $sql = "UPDATE measurements SET value='$value', unit='$unit', time='$time' WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function delete($id) 
    {
        $id = (int)$id;
        $sql = "DELETE FROM measurements WHERE id=$id";
        $this->db->sendQuery($sql);
        return $this->db->MySQLi->affected_rows > 0;
    }

    public function getAll() {
        $sql = "SELECT * FROM measurements";
        $result = $this->db->sendQuery($sql);
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
