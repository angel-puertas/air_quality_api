<?php
class API extends AbstractPage {
    public function execute() 
    {
        $response = $_GET;

        $base = $response['base'];
        
        $apiUrl = "https://openexchangerates.org/api/{$endpoint}.json?app_id=88fb2542e8a14ceb8e193f34110dfc46"; //this must be changed in the future (link is for currencies)
    }
}
?>