<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class IndexPage extends AbstractPage 
{
    protected $templateName = 'index';

    public function execute() 
    {
        $resources = [
            [
                'resource'    => 'Register',
                'url'         => '?page=Register&username={username}&password={password}&confirm_password={confirm_password}',
                'description' => 'Register a new user.'
            ],
            [
                'resource'    => 'Login',
                'url'         => '?page=Login&username={username}&password={password}',
                'description' => 'Authenticate user and start session.'
            ],
            [
                'resource'    => 'Logout',
                'url'         => '?page=Logout',
                'description' => 'Logout the current user.'
            ],
            [
                'resource'    => 'Stations - List',
                'url'         => '?page=StationList',
                'description' => 'Get a list of all monitoring stations.'
            ],
            [
                'resource'    => 'Stations - View',
                'url'         => '?page=StationView&id={id}',
                'description' => 'Get data for a single station by ID.'
            ],
            [
                'resource'    => 'Stations - Create',
                'url'         => '?page=StationCreate&name={name}',
                'description' => 'Create a new station.'
            ],
            [
                'resource'    => 'Stations - Update',
                'url'         => '?page=StationUpdate&id={id}&name={name}',
                'description' => 'Update a station by ID.'
            ],
            [
                'resource'    => 'Stations - Delete',
                'url'         => '?page=StationDelete&id={id}',
                'description' => 'Delete a station by ID.'
            ],
            [
                'resource'    => 'Pollutants - List',
                'url'         => '?page=PollutantList',
                'description' => 'Get a list of all pollutants.'
            ],
            [
                'resource'    => 'Pollutants - View',
                'url'         => '?page=PollutantView&id={id}',
                'description' => 'Get data for a single pollutant by ID.'
            ],
            [
                'resource'    => 'Pollutants - Create',
                'url'         => '?page=PollutantCreate&name={name}',
                'description' => 'Create a new pollutant.'
            ],
            [
                'resource'    => 'Pollutants - Update',
                'url'         => '?page=PollutantUpdate&id={id}&name={name}',
                'description' => 'Update a pollutant by ID.'
            ],
            [
                'resource'    => 'Pollutants - Delete',
                'url'         => '?page=PollutantDelete&id={id}',
                'description' => 'Delete a pollutant by ID.'
            ],
            [
                'resource'    => 'Measurements - List',
                'url'         => '?page=MeasurementList',
                'description' => 'Get all measurements. Optional query: &station_id={id}&pollutant_id={id} // &station_id={id} // &pollutant_id={id} // &id={id} <br> For fake test: &fake=true'
            ],            
            [
                'resource'    => 'Api',
                'url'         => '?page=Api',
                'description' => 'Get data from external API and store into DB. Example:<br>
            ?page=Api&station=307&pollutant=1&type=0&fromDate=26.05.2024&toDate=06.06.2024'
            ],
        ];

        $this->data = 
        [
            'resources' => $resources
        ];
    }
}

$page = new IndexPage();
?>
