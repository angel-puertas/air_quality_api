<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class IndexPage extends AbstractPage 
{
    protected $templateName = 'index';

    public function execute() 
    {
        $resources = 
        [
            [
                'resource'    => 'Register',
                'url'         => '?page=Register',
                'method'      => 'POST',
                'body'        => '{ username=NAME, password=PSWD6, confirm_password=PSWD }',
                'description' => 'Register a new user.'
            ],
            [
                'resource'    => 'Login',
                'url'         => '?page=Login',
                'method'      => 'POST',
                'body'        => '{ username=NAME, password=PSWD }',
                'description' => 'Authenticate user and start session.'
            ],
            [
                'resource'    => 'Logout',
                'url'         => '?page=Logout',
                'method'      => 'POST',
                'description' => 'Logout the current user.'
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
                'body'        => '{ name=NAME }',
                'description' => 'Create a new station.'
            ],
            [
                'resource'    => 'Stations - Update',
                'url'         => '?page=StationUpdate',
                'body'        => '{ id=ID, name=NAME }',
                'method'      => 'PUT',
                'description' => 'Update a station by ID.'
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
                'body'        => '{ name=NAME }',
                'description' => 'Create a new pollutant.'
            ],
            [
                'resource'    => 'Pollutants - Update',
                'url'         => '?page=PollutantUpdate',
                'method'      => 'PUT',
                'body'        => '{ id=ID, name=NAME }',
                'description' => 'Update a pollutant by ID.'
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
                'description' => 'Get all measurements. Optional query: &station_id={id}&pollutant_id={id} // &station_id={id} // &id={id}'
            ],            
            [
                'resource'    => 'Api',
                'url'         => '?page=Api',
                'method'      => 'GET',
                'description' => 'Get data from external API and store into database. Example: ?page=Api&station=307&pollutant=1&type=0&fromDate=26.05.2024&toDate=06.06.2024'
            ]
        ];

        $this->data = 
        [
            'resources' => $resources
        ];
    }
}

$page = new IndexPage();
?>
