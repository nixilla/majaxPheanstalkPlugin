<?php

/**
 * Task to print out the Beanstalk stats
 *
 * @package    majaxPheanstalkPlugin
 * @subpackage task
 */

class pheanstalkStatsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'pheanstalk';
    $this->name             = 'stats';
    $this->briefDescription = 'prints out the Beanstalk stats';
    $this->detailedDescription = <<<EOF
The [pheanstalk:stats|INFO] task prints out the Beanstalk stats
Call it with:

  [php symfony pheanstalk:stats|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    foreach(majaxPheanstalk::getInstance()->stats() as $name => $val)
      $this->logSection($name, $val);
  }
}
