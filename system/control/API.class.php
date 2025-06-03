<?php
class API {
    private $apiURL;
    private $response;
    private $data;
    
    public function setURL($url) {
        $this->apiURL = $url;
    }

    public function fetchData() {
        $ch = curl_init($this->apiURL);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $this->response = curl_exec($ch);
        
        if ($this->response === false) {
            throw new SystemException('API Error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        $this->data = json_decode($this->response, true);
        
        return $this->data;
    }

    public function getExchangeRate() {
        if (empty($this->data)) {
            $this->fetchData();
        }
        
        $seaTemps = [];
        
        if (isset($this->data['sea_temps'])) {
            foreach ($this->data['sea_temps'] as $item) {
                $seaTemps[] = [
                    'location' => $item['location'] ?? 'Unknown',
                    'temperature' => $item['tempdeset'] ?? 'N/A',
                    'condition' => $item['stanjetla'] ?? 'N/A',
                    'time' => $item['time'] ?? 'N/A'
                ];
            }
        }
        
        return $seaTemps;
    }
}
?>