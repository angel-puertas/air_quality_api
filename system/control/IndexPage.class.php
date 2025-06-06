<?php
require_once(__DIR__ . '/AbstractPage.class.php');

class IndexPage extends AbstractPage {
    public $templateName = 'index';

    public function execute() 
    {
        $resources = [
            [
                'resource'    => 'Register',
                'url'         => '?page=RegisterPage',
                'method'      => 'POST',
                'description' => 'Register a new user. Body: {"username": "...", "password": "..."}'
            ],
            [
                'resource'    => 'Login',
                'url'         => '?page=LoginPage',
                'method'      => 'POST',
                'description' => 'Authenticate user and start session. Body: {"username": "...", "password": "..."}'
            ],
            [
                'resource'    => 'Stations - List',
                'url'         => '?page=station/StationListPage',
                'method'      => 'GET',
                'description' => 'Get a list of all monitoring stations.'
            ],
            [
                'resource'    => 'Stations - View',
                'url'         => '?page=station/StationViewPage&id={id}',
                'method'      => 'GET',
                'description' => 'Get data for a single station by ID.'
            ],
            [
                'resource'    => 'Stations - Create',
                'url'         => '?page=station/StationCreatePage',
                'method'      => 'POST',
                'description' => 'Create a new station. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Stations - Update',
                'url'         => '?page=station/StationUpdatePage&id={id}',
                'method'      => 'PUT',
                'description' => 'Update a station by ID. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Stations - Delete',
                'url'         => '?page=station/StationDeletePage&id={id}',
                'method'      => 'DELETE',
                'description' => 'Delete a station by ID.'
            ],
            [
                'resource'    => 'Pollutants - List',
                'url'         => '?page=pollutant/PollutantListPage',
                'method'      => 'GET',
                'description' => 'Get a list of all pollutants.'
            ],
            [
                'resource'    => 'Pollutants - View',
                'url'         => '?page=pollutant/PollutantViewPage&id={id}',
                'method'      => 'GET',
                'description' => 'Get data for a single pollutant by ID.'
            ],
            [
                'resource'    => 'Pollutants - Create',
                'url'         => '?page=pollutant/PollutantCreatePage',
                'method'      => 'POST',
                'description' => 'Create a new pollutant. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Pollutants - Update',
                'url'         => '?page=pollutant/PollutantUpdatePage&id={id}',
                'method'      => 'PUT',
                'description' => 'Update a pollutant by ID. Body: {"name": "..."}'
            ],
            [
                'resource'    => 'Pollutants - Delete',
                'url'         => '?page=pollutant/PollutantDeletePage&id={id}',
                'method'      => 'DELETE',
                'description' => 'Delete a pollutant by ID.'
            ],
            [
                'resource'    => 'Measurements - List',
                'url'         => '?page=measurement/MeasurementListPage',
                'method'      => 'GET',
                'description' => 'Get all measurements. Optional query: ?station_id={id}&pollutant_id={id}'
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
                'url'         => '?page=LogoutPage',
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
