<?php

use PHPUnit\Framework\TestCase;
use Clock\ClockAngle;

class ClockAngleTest extends TestCase
{

    protected $clockAngle;

    protected function setUp()
    {
        $this->clockAngle = new ClockAngle();
    }

    /**
     * @param string $time to be validated
     *
     * @dataProvider providerTestTimeReturnsValidTime
     */
    public function testValidateTimeReturnsValidTime($time)
    {
        $result = $this->clockAngle->validateTime($time);

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
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);

        $this->assertEquals($time, $this->clockAngle->getTime());
	}

    public function testHourAndMinute()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $expectedOutput = ['hour' => '02', 'minute' => '20'];
        $result = $this->clockAngle->getHourAndMinute();

        $this->assertEquals($expectedOutput, $result);
    } 

    public function testHourAngle()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $result = $this->clockAngle->getHourAngle();

        $this->assertEquals(70, $result);
    }

    public function testMinuteAngle()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $result = $this->clockAngle->getMinuteAngle();

        $this->assertEquals(120, $result);
    }

    public function testInnerAngle()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $result = $this->clockAngle->getInnerAngleBetweenHands();

        $this->assertEquals(50, $result);
    }

    public function testOutterAngle()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $result = $this->clockAngle->getOutterAngleBetweenHands();

        $this->assertEquals(310, $result);
    }

    public function testSuperImposition()
    {
        $time = '02:20';
        if (!$this->clockAngle->validateTime($time)) {
            $this->assertFalse('Invalid Input!: ' . $time);
        }
        $this->clockAngle->setTime($time);
        $result = $this->clockAngle->checkSuperImposition();

        $this->assertTrue($result);
    }

    protected function tearDown()
    {
        unset($this->clockAngle); 
    }

}
