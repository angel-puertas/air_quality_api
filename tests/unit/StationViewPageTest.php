<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../system/control/StationViewPage.class.php');
require_once(__DIR__ . '/../../system/model/Station.class.php');

class TestableStationViewPage extends StationViewPage {
    private $mockStation;
    
    public function setMockStation($mockStation) {
        $this->mockStation = $mockStation;
    }
    
    protected function createStationModel() {
        return $this->mockStation;
    }
    
    public function getData() {
        return $this->data;
    }
}

class StationViewPageTest extends TestCase
{
    public function testExecuteWithValidId()
    {
        $_GET['id'] = '5';
        $expectedStation = ['id' => 5, 'name' => 'Test Station'];
        
        $stationMock = $this->createMock(Station::class);
        $stationMock->method('getById')
                   ->willReturn($expectedStation);
        
        $reflection = new ReflectionClass(TestableStationViewPage::class);
        $stationViewPage = $reflection->newInstanceWithoutConstructor(); // constructor would call execute method
        
        $stationViewPage->setMockStation($stationMock);
        
        $stationViewPage->execute();
        
        $this->assertEquals($expectedStation, $stationViewPage->getData());
    }
}
?>