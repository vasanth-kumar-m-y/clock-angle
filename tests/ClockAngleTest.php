<?php

use PHPUnit\Framework\TestCase;
use Clock\ClockAngle;

class ClockAngleTest extends TestCase
{

    /**
     * @param string $time to be validated
     *
     * @dataProvider providerTestTimeReturnsValidTime
     */
    public function testValidateTimeReturnsValidTime($time)
    {
        $clockAngle = new ClockAngle();
        $result = $clockAngle->validateTime($time);

        $this->assertTrue($result);
    }

    public function providerTestTimeReturnsValidTime()
    {
        return array(
            array('02:20'),
            array('22:20'),
            array(123),
            array(12.5),
            array('test'),
            array(True),
            array(''),
        );
    }

    public function testSetTimeAndGetTime()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);

        $this->assertEquals($time, $clockAngle->getTime());
	}

    public function testHourAndMinute()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $expectedOutput = ['hour' => '02', 'minute' => '20'];
        $result = $clockAngle->getHourAndMinute();

        $this->assertEquals($expectedOutput, $result);
    } 

    public function testHourAngle()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $result = $clockAngle->getHourAngle();

        $this->assertEquals(70, $result);
    }

    public function testMinuteAngle()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $result = $clockAngle->getMinuteAngle();

        $this->assertEquals(120, $result);
    }

    public function testInnerAngle()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $result = $clockAngle->getInnerAngleBetweenHands();

        $this->assertEquals(50, $result);
    }

    public function testOutterAngle()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $result = $clockAngle->getOutterAngleBetweenHands();

        $this->assertEquals(310, $result);
    }

    public function testSuperImposition()
    {
        $clockAngle = new ClockAngle();
        $time = '02:20';
        if (!$clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $clockAngle->setTime($time);
        $result = $clockAngle->checkSuperImposition();

        $this->assertTrue($result);
    }

}
