<?php
class IndexPage extends AbstractPage {
    public $templateName = 'index';

    public function execute() {
        $resources = [
            1 => [
                'url' => 'Index',
                'method' => 'GET',
                'description' => 'Placeholder.'
            ]
        ];
        
        $this->data = [
            'resources' => $resources
        ];
    }
}
?>
