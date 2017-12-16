<?php

use Mockery as m;

class CacheMemcachedConnectorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        if ($container = m::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        m::close();
    }

    public function testServersAreAddedCorrectly()
    {
        $connector = $this->getMockBuilder('Illuminate\Cache\MemcachedConnector')->setMethods(['getMemcached'])->getMock();
        $memcached = m::mock('stdClass');
        $memcached->shouldReceive('addServer')->once()->with('localhost', 11211, 100);
        $memcached->shouldReceive('getVersion')->once()->andReturn([]);
        $connector->expects($this->once())->method('getMemcached')->will($this->returnValue($memcached));
        $result = $connector->connect([['host' => 'localhost', 'port' => 11211, 'weight' => 100]]);

        $this->assertSame($result, $memcached);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testExceptionThrownOnBadConnection()
    {
        $connector = $this->getMockBuilder('Illuminate\Cache\MemcachedConnector')->setMethods(['getMemcached'])->getMock();
        $memcached = m::mock('stdClass');
        $memcached->shouldReceive('addServer')->once()->with('localhost', 11211, 100);
        $memcached->shouldReceive('getVersion')->once()->andReturn(['255.255.255']);
        $connector->expects($this->once())->method('getMemcached')->will($this->returnValue($memcached));
        $result = $connector->connect([['host' => 'localhost', 'port' => 11211, 'weight' => 100]]);
    }
}
