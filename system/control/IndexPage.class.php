<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class IndexPage extends AbstractPage {
    protected $templateName = 'index';

    public function execute() 
    {
        $resources = [
            [
                'resource'    => 'Register',
                'url'         => '?page=Register',
                'method'      => 'POST',
                'description' => 'Register a new user. Body: {"username": "...", "password": "..."}'
            ],
            [
                'resource'    => 'Login',
                'url'         => '?page=Login',
                'method'      => 'POST',
                'description' => 'Authenticate user and start session. Body: {"username": "...", "password": "..."}'
            ],
            [
                'resource'    => 'Stations - List',
                'url'         => '?page=StationList',
                'method'      => 'GET',
                'description' => 'Get a list of all monitoring stations.'
            ],
            [
                'resource'    => 'Stations - View',
                'url'         => '?page=StationView&id={id}',
                'method'      => 'GET',
                'description' => 'Get data for a single station by ID.'
            ],
            [
                'resource'    => 'Stations - Create',
                'url'         => '?page=StationCreate',
                'method'      => 'POST',
                'description' => 'Create a new station. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Stations - Update',
                'url'         => '?page=StationUpdate&id={id}',
                'method'      => 'PUT',
                'description' => 'Update a station by ID. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Stations - Delete',
                'url'         => '?page=StationDelete&id={id}',
                'method'      => 'DELETE',
                'description' => 'Delete a station by ID.'
            ],
            [
                'resource'    => 'Pollutants - List',
                'url'         => '?page=PollutantList',
                'method'      => 'GET',
                'description' => 'Get a list of all pollutants.'
            ],
            [
                'resource'    => 'Pollutants - View',
                'url'         => '?page=PollutantView&id={id}',
                'method'      => 'GET',
                'description' => 'Get data for a single pollutant by ID.'
            ],
            [
                'resource'    => 'Pollutants - Create',
                'url'         => '?page=PollutantCreate',
                'method'      => 'POST',
                'description' => 'Create a new pollutant. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Pollutants - Update',
                'url'         => '?page=PollutantUpdate&id={id}',
                'method'      => 'PUT',
                'description' => 'Update a pollutant by ID. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Pollutants - Delete',
                'url'         => '?page=PollutantDelete&id={id}',
                'method'      => 'DELETE',
                'description' => 'Delete a pollutant by ID.'
            ],
            [
                'resource'    => 'Measurements - List',
                'url'         => '?page=MeasurementList',
                'method'      => 'GET',
                'description' => 'Get all measurements. Optional query: ?station_id={id}&pollutant_id={id}'
            ],
            [
                'resource'    => 'Measurements - JSON',
                'url'         => '?page=MeasurementListJSON',
                'method'      => 'GET',
                'description' => 'Get all measurements in json format. Optional query: ?station_id={id}&pollutant_id={id}'
            ],
            
            [
                'resource'    => 'Api',
                'url'         => '?page=Api',
                'method'      => 'GET',
                'example'     => '?page=Api&postaja=307&polutant=1&tipPodatka=0&vrijemeOd=26.05.2024&vrijemeDo=06.06.2024',
                'description' => 'Retreive data from the API. Example: ?page=Api&postaja=307&polutant=1&tipPodatka=0&vrijemeOd=26.05.2024&vrijemeDo=06.06.2024'
            ],
            
            [
                'resource'    => 'Logout',
                'url'         => '?page=Logout',
                'method'      => 'POST',
                'description' => 'Logout the current user.'
            ],
        ];

        $this->data = [
            'resources' => $resources
        ];
    }
}

$page = new IndexPage();
?>
