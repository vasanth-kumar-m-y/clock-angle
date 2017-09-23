<?php

use PHPUnit\Framework\TestCase;
use Clock\ClockAngleCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ClockAngleCommandTest extends TestCase
{

    public function testClockAngleCommandWithTime()
    {
		$application = new Application();
        $application->add(new ClockAngleCommand());

        $command = $application->find('ClockAngle:ClockAngle');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'Time' => '02:20'
        ));	
        
		$this->assertRegExp('/The Hour Angle is:/', $commandTester->getDisplay());
	}

    public function testClockAngleCommandWithTimeAndFilter()
    {
        $application = new Application();
        $application->add(new ClockAngleCommand());

        $command = $application->find('ClockAngle:ClockAngle');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'Time' => '02:20',
            '--filter' => 'hour'
        )); 
        
        $this->assertRegExp('/The Hour Angle is:/', $commandTester->getDisplay());
    }

}


?>
