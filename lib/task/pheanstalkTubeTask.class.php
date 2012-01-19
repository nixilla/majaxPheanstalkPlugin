<?php

/**
 * Task to print out the Beanstalk tube stats
 *
 * @package    majaxPheanstalkPlugin
 * @subpackage task
 */

class pheanstalkTubeTask extends sfBaseTask
{
  protected function configure()
  {
    // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('tube_name', sfCommandArgument::REQUIRED, 'The name of the tube to look at'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'pheanstalk';
    $this->name             = 'tube';
    $this->briefDescription = 'prints out stats for given tube name';
    $this->detailedDescription = <<<EOF
The [pheanstalk:tube|INFO] task prints out stats for given tube name.
Call it with:

  [php symfony pheanstalk:tube|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    foreach(majaxPheanstalk::getInstance()->statsTube($arguments['tube_name']) as $name => $val)
      $this->logSection($name, $val);
  }
}
