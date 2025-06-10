<?php
require_once(__DIR__ . '/AbstractModel.class.php');
class Measurement extends AbstractModel {

    public function create($station_id, $pollutant_id, $value, $unit, $time) // why no unit?? 
    {
        // TESTING THIS FOR APIPAGE
        $stmt = $this->db->prepare("
        SELECT id 
        FROM measurements 
        WHERE station_id = ? 
        AND pollutant_id = ? 
        AND value = ? 
        AND unit = ? 
        AND time = ?
        ");
        $stmt->bind_param("iisss", $station_id, $pollutant_id, $value, $unit, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Measurement already exists, return existing ID
            $measurement = $result->fetch_assoc();
            $stmt->close();
            return $measurement['id'];
        }
        $stmt->close();


        $stmt = $this->db->prepare("
            INSERT INTO measurements (station_id, pollutant_id, value, unit, time)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("iisss", $station_id, $pollutant_id, $value, $unit, $time);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();
        return $insertId;
    }

    public function getByStation($station_id) //this was missing before
    {
        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE station_id = ?");
        $stmt->bind_param("i", $station_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $measurements = [];
        if ($result) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $measurements[] = $row;
            }
            $result->free();
        }
        $stmt->close();
        return $measurements;
    }

    public function getById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $measurement = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $measurement;
    }

    public function getByStationAndPollutant($station_id, $pollutant_id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM measurements WHERE station_id = ? AND pollutant_id = ?");
        $stmt->bind_param("ii", $station_id, $pollutant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $measurements = [];
        while ($row = $result->fetch_assoc()) {
            $measurements[] = $row;
        }
        $result->free();
        $stmt->close();
        return $measurements;
    }

    public function update($id, $value, $unit, $time) 
    {
        $stmt = $this->db->prepare("UPDATE measurements SET value = ?, unit = ?, time = ? WHERE id = ?");
        $stmt->bind_param("sssi", $value, $unit, $time, $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM measurements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    public function getAll() 
    {
        $stmt = $this->db->prepare("SELECT * FROM measurements");
        $stmt->execute();
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
        $result->free();
        $stmt->close();
        return $measurements;
    }


    public function fakeStation()
    {
        return [
            [
                'id' => 1,
                'station_id' => 999,
                'pollutant_id' => 1,
                'value' => 40,
                'unit' => "%",
                'time' => 123456
            ],
            [
                'id' => 2,
                'station_id' => 999,
                'pollutant_id' => 1,
                'value' => 50,
                'unit' => "%",
                'time' => 980000
            ],
            [
                'id' => 3,
                'station_id' => 999,
                'pollutant_id' => 1,
                'value' => 60,
                'unit' => "%",
                'time' => 717711
            ]
        ];
    }
}
?>
