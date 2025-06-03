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

    public function getExchangeRates() {
        if (empty($this->data)) {
            $this->fetchData();
        }
        return $this->data['rates'] ?? [];
    }
}
?>