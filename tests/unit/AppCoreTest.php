<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../system/AppCore.class.php';

class AppCoreTest extends TestCase
{
    protected function setUp(): void
    {
        // Reset the static database object before each test
        $reflection = new ReflectionClass('AppCore');
        $property = $reflection->getProperty('dbObj');
        $property->setAccessible(true);
        $property->setValue(null, null);
    }

    public function testGetDBMethodExists()
    {
        $this->assertTrue(method_exists('AppCore', 'getDB'));
    }

    public function testGetDBIsStatic()
    {
        $reflection = new ReflectionMethod('AppCore', 'getDB');
        $this->assertTrue($reflection->isStatic());
    }

    public function testGetDBReturnsNullBeforeInitialization()
    {
        $result = AppCore::getDB();
        $this->assertNull($result);
    }

    public function testGetDBReturnsObjectAfterInitialization()
    {
        $appCore = new AppCore(false);
        $result = AppCore::getDB();
        
        $this->assertNotNull($result);
    }

    public function testGetDBReturnsSameInstance()
    {
        new AppCore(false);
        
        $db1 = AppCore::getDB();
        $db2 = AppCore::getDB();
        
        $this->assertSame($db1, $db2);
    }

    protected function tearDown(): void
    {
        // Clean up after each test
        $reflection = new ReflectionClass('AppCore');
        $property = $reflection->getProperty('dbObj');
        $property->setAccessible(true);
        $property->setValue(null, null);
    }
}
?>