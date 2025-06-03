<?php
class API {
    public function execute() {
        $response = $_GET;
        $endpoint = $response['endpoint']; // latest.json, currencies.json
        $base = $reponse['base'];
        
        $apiUrl = "https://openexchangerates.org/api/{$endpoint}.json?app_id=88fb2542e8a14ceb8e193f34110dfc46";
    }
}
?>