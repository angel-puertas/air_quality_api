<?php

require_once('API.class.php');

class IndexPage {
    public function __construct() {
        $api = new API();
        $api->setURL('https://openexchangerates.org/api/latest.json?app_id=88fb2542e8a14ceb8e193f34110dfc46');
        $rates = $api->getExchangeRates();
        include('system/view/index.tpl.php');
    }
}
?>
