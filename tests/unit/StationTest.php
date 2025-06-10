<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

// Include required classes
require_once __DIR__ . '/../../system/model/AbstractModel.class.php';
require_once __DIR__ . '/../../system/model/Station.class.php';

/**
 * @covers Station
 */
class StationTest extends TestCase
{
    private $station;
    private $dbMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dbMock = $this->createMock(mysqli::class);
        $this->station = new Station($this->dbMock);
    }

    public function testGetStationById(): void
    {
        $id = 1;
        $name = 'Test Station';

        // Mock the database prepare and execute methods
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->dbMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("SELECT * FROM stations WHERE id = ?"))
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->equalTo($id));

        $stmtMock->expects($this->once())
            ->method('execute');

        $stmtMock->expects($this->once())
            ->method('get_result')
            ->willReturn($resultMock);

        $resultMock->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(['id' => $id, 'name' => $name]);

        $resultMock->expects($this->once())
            ->method('free');

        $stmtMock->expects($this->once())
            ->method('close');

        $station = $this->station->getById($id);
        
        $this->assertIsArray($station);
        $this->assertArrayHasKey('id', $station);
        $this->assertArrayHasKey('name', $station);
        $this->assertEquals($name, $station['name']);
    }

    private function getPropertyValue($object, $propertyName)
    {
        $reflectionClass = new \ReflectionClass($object);
        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}