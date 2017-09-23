<?php

namespace Clock\interfaces;

/**
 * Interface TimeAngleServiceInterface
 */
interface TimeAngleServiceInterface{
    
    /**
	 * @param string $time 
	 */
	public function setTime($time);

    /**
	 * @return string 
	 */
	public function getTime();
    
    /**
	 * @return float 
	 */
	public function getHourAngle();
    
    /**
	 * @return float 
	 */
	public function getMinuteAngle();

    /**
	 * @return float 
	 */
	public function getInnerAngleBetweenHands();
    
    /**
	 * @return float 
	 */
	public function getOutterAngleBetweenHands();

}

?>