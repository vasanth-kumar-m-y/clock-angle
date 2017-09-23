<?php

declare(strict_types=1);

namespace Clock;

use Clock\interfaces\TimeAngleServiceInterface;

class ClockAngle implements TimeAngleServiceInterface
{

	/**
     * @const float
     */
	private const FULL_ROTATION_DEGREES = 360;
    private const HOUR_HAND_DEGREE_ROTATION_PER_MINUTES = 0.5;
    private const MINUTE_HAND_DEGREE_ROTATION_PER_MINUTES = 6;
    private const ONE_HOUR_IN_MINUTES = 60;
    private const SUPER_IMPOSED_IN_MINUTES = 5.45;

    /**
     * @var string
     */
	private $time;

	/**
	 * Validates the time is in correct format
	 *
	 * @param string $time
	 *
	 * @return boolean
	 */
	public static function validateTime(string $time): bool
	{
		if(preg_match("/(1[012]|0[1-9]):([0-5][0-9])/", $time)) {
			return true;
		}
		return false;
	}

	/**
	 * Receives a time and set value into property
	 *
	 * @param string $time
	 */
	public function setTime($time)
	{
        $this->time = $time;
	}
  
    /**
     * Returns a time string
     *
	 * @return string $time 
	 */
	public function getTime()
	{
        return $this->time;
	}

	/**
     * Returns an array of hour and minute
     *
	 * @return array $hourAndMinute
	 */
	public function getHourAndMinute()
	{
		$keys = ['hour', 'minute'];
		$hourAndMinute = array_combine($keys, explode(':', $this->getTime()));

        return $hourAndMinute;
	}
    
    /**
     * Returns a hour angle
     *
	 * @return float 
	 */
	public function getHourAngle()
	{
		$hourAndMinute = $this->getHourAndMinute();
        $hourAngle = self::HOUR_HAND_DEGREE_ROTATION_PER_MINUTES * ($hourAndMinute['hour'] * self::ONE_HOUR_IN_MINUTES + $hourAndMinute['minute']);

        return $hourAngle;
	}
    
    /**
     * Returns a minute angle
     *
	 * @return float 
	 */
	public function getMinuteAngle()
	{
        $hourAndMinute = $this->getHourAndMinute();
        $minuteAngle = self::MINUTE_HAND_DEGREE_ROTATION_PER_MINUTES * $hourAndMinute['minute'];

        return $minuteAngle;
	}
  
    /**
     * Returns a inner angle between hour and minute
     *
	 * @return float 
	 */
	public function getInnerAngleBetweenHands()
	{
        $innerAngle = abs($this->getHourAngle() - $this->getMinuteAngle());

        return $innerAngle;
	}
    
    /**
     * Returns a outter angle between hour and minute
     *
	 * @return float 
	 */
	public function getOutterAngleBetweenHands()
	{
		$angle = $this->getInnerAngleBetweenHands();
        $outterAngle = self::FULL_ROTATION_DEGREES - $angle;

        return $outterAngle;
	}

	/**
     * Checks for superimposition angle
     *
	 * @return boolean 
	 */
	public function checkSuperImposition()
	{
		$hourAndMinute = $this->getHourAndMinute();
        $angle = self::SUPER_IMPOSED_IN_MINUTES * $hourAndMinute['hour'];

        if($hourAndMinute['minute'] == $angle) {
        	return true;
        }
        return false;
	}

}
