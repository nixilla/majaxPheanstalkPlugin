<?php

/**
 * Task to print out the Beanstalk registered tubes
 *
 * @package    majaxPheanstalkPlugin
 * @subpackage task
 */

class pheanstalkTubesTask extends sfBaseTask
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
    $this->name             = 'tubes';
    $this->briefDescription = 'prints out registered tube names';
    $this->detailedDescription = <<<EOF
The [pheanstalk:tubes|INFO] task prints out registered tube names
Call it with:

  [php symfony pheanstalk:tubes|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    foreach(majaxPheanstalk::getInstance()->listTubes() as $idx => $tube)
      $this->logSection(++$idx, $tube);
  }
}
