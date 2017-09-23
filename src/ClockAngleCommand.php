<?php

namespace Clock;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Clock\ClockAngle;

class ClockAngleCommand extends Command
{

	protected function configure()
	{
		$this->setName("ClockAngle:ClockAngle")
				->setDescription("clock angle command to get angle")
				->addArgument('Time', InputArgument::REQUIRED, 'For what time do you wish to get angle')
				->addOption('filter', null, InputOption::VALUE_OPTIONAL, 'What type of angle do you wish to get');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$clockAngle = new ClockAngle();
		$time = $input->getArgument('Time');
		$filter = $input->getOption('filter');
		
		$validTime = $clockAngle->validateTime($time);

		if($validTime){
			$clockAngle->setTime($time);

			if($clockAngle->checkSuperImposition()) {
				$output->writeln('The given time is superimposed!: ' . $time);
				return true;
			}

			switch ($filter) {
			    case 'hour':
		    		$output->writeln('The Hour Angle is: ' . $clockAngle->getHourAngle());
			        break;
			    case 'minute':
		    		$output->writeln('The Minute Angle is: ' . $clockAngle->getMinuteAngle());
			        break;
			    case 'internal':
		    		$output->writeln('The Inner Angle is: ' . $clockAngle->getInnerAngleBetweenHands());
			        break;
			    case 'external':
		    		$output->writeln('The Outter Angle is: ' . $clockAngle->getOutterAngleBetweenHands());
			        break;
			    default:
				    $output->writeln('The Hour Angle is: ' . $clockAngle->getHourAngle());
				    $output->writeln('The Minute Angle is: ' . $clockAngle->getMinuteAngle());
				    $output->writeln('The Inner Angle is: ' . $clockAngle->getInnerAngleBetweenHands());
				    $output->writeln('The Outter Angle is: ' . $clockAngle->getOutterAngleBetweenHands());
			}
			return true;
		}

		$output->writeln('Invalid Input!: ' . $time);
	}

}
