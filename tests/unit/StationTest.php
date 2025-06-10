<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../system/model/Station.class.php');
require_once(__DIR__ . '/../../system/model/AbstractModel.class.php');

class StationTest extends TestCase
{
    private $mockDb;
    private $mockStmt;
    private $mockResult;
    
    protected function setUp(): void
    {
        $this->mockDb = $this->createMock(\mysqli::class);
        $this->mockStmt = $this->createMock(\mysqli_stmt::class);
        $this->mockResult = $this->createMock(\mysqli_result::class);
        
        $this->mockStmt->method('insert_id')->willReturn(1);
    }
    
    public function testCreateStation()
    {
        $testName = 'Test Station';
        
        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with("s", $testName);
        
        $this->mockStmt->expects($this->once())
            ->method('execute');
        
        $this->mockStmt->expects($this->once())
            ->method('close');
        
        $this->mockDb->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO stations (name) VALUES (?)")
            ->willReturn($this->mockStmt);
        
        $station = new Station($this->mockDb);
        $result = $station->create($testName);
        
        $this->assertEquals(1, $result);
    }
    
    public function testGetById()
    {
        $testId = 1;
        $expectedStation = ['id' => 1, 'name' => 'Test Station'];
        
        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with("i", $testId);
        
        $this->mockStmt->expects($this->once())
            ->method('execute');
        
        $this->mockStmt->expects($this->once())
            ->method('get_result')
            ->willReturn($this->mockResult);
        
        $this->mockResult->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn($expectedStation);
        
        $this->mockResult->expects($this->once())
            ->method('free');
        
        $this->mockStmt->expects($this->once())
            ->method('close');
        
        $this->mockDb->expects($this->once())
            ->method('prepare')
            ->with("SELECT * FROM stations WHERE id = ?")
            ->willReturn($this->mockStmt);
        
        $station = new Station($this->mockDb);
        $result = $station->getById($testId);
        
        $this->assertEquals($expectedStation, $result);
    }
}