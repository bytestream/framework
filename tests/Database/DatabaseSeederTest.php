<?php

use Mockery as m;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        //
    }
}

class DatabaseSeederTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        if ($container = m::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        m::close();
    }

    public function testCallResolveTheClassAndCallsRun()
    {
        $seeder = new TestSeeder;
        $seeder->setContainer($container = m::mock('Illuminate\Container\Container'));
        $output = m::mock('Symfony\Component\Console\Output\OutputInterface');
        $output->shouldReceive('writeln')->once()->andReturn('foo');
        $command = m::mock('Illuminate\Console\Command');
        $command->shouldReceive('getOutput')->once()->andReturn($output);
        $seeder->setCommand($command);
        $container->shouldReceive('make')->once()->with('ClassName')->andReturn($child = m::mock('StdClass'));
        $child->shouldReceive('setContainer')->once()->with($container)->andReturn($child);
        $child->shouldReceive('setCommand')->once()->with($command)->andReturn($child);
        $child->shouldReceive('run')->once();

        $seeder->call('ClassName');
    }

    public function testSetContainer()
    {
        $seeder = new TestSeeder;
        $container = m::mock('Illuminate\Container\Container');
        $this->assertEquals($seeder->setContainer($container), $seeder);
    }

    public function testSetCommand()
    {
        $seeder = new TestSeeder;
        $command = m::mock('Illuminate\Console\Command');
        $this->assertEquals($seeder->setCommand($command), $seeder);
    }
}
