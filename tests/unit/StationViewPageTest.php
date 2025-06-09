<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../system/control/StationViewPage.class.php');
require_once(__DIR__ . '/../../system/model/Station.class.php');
require_once(__DIR__ . '/../../system/AppCore.class.php');

class TestableStationViewPage extends StationViewPage {
    protected $hasBeenCalled = false;
    protected $hasShown = false;
    
    public function execute() {
        if ($this->hasBeenCalled) {
            parent::execute();
        } else {
            $this->hasBeenCalled = true;
        }
    }
    
    public function show() {
        if ($this->hasShown) {
            parent::show();
        } else {
            $this->hasShown = true;
        }
    }
}

class StationViewPageTest extends TestCase
{
    public function testExecuteWithValidId()
    {
        $expectedStation = ['id' => 5, 'name' => 'Test Station'];
        
        $mockDb = $this->createMock(\mysqli::class);
        
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->method('fetch_assoc')
                  ->willReturn($expectedStation);
        $mockResult->method('free')
                  ->willReturnSelf();
        
        $mockStmt->method('get_result')
                ->willReturn($mockResult);
        $mockStmt->method('bind_param')
                ->willReturn(true);
        $mockStmt->method('execute')
                ->willReturn(true);
        $mockStmt->method('close')
                ->willReturn(true);
        
        $mockDb->method('prepare')
               ->willReturn($mockStmt);
        
        $appCoreProperty = new ReflectionProperty(AppCore::class, 'dbObj');
        $appCoreProperty->setAccessible(true);
        $appCoreProperty->setValue(null, $mockDb);
        
        $_GET['id'] = 5;
        
        $stationViewPage = new TestableStationViewPage();
        
        $stationViewPage->execute();
        
        $dataProperty = new ReflectionProperty(TestableStationViewPage::class, 'data');
        $dataProperty->setAccessible(true);
        $actualData = $dataProperty->getValue($stationViewPage);
        
        $this->assertEquals($expectedStation, $actualData);
    }
}