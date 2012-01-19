<?php

/**
 * Singleton wrapper to Pheanstalk
 *
 * @package    majaxPheanstalkPlugin
 */
class majaxPheanstalk
{
  static $conn = null;

  /**
   * @static
   * @return Pheanstalk object
   */
  public static function getInstance()
  {
    if (self::$conn == null)
    {
      self::$conn = new Pheanstalk(
        sprintf(
          '%s:%s',
          sfConfig::get('app_pheanstalk_host', '127.0.0.1'),
          sfConfig::get('app_pheanstalk_port', 11300)
        )
      );
    }

    return self::$conn;
  }

  /**
   * @static
   * @param $tube
   * @param $job_data
   */
  public static function addJob($tube, $job_data)
  {
    $p = self::getInstance();
    $p->useTube($tube)->addJob($job_data);
  }

  /**
   * @static
   * @param $tube
   * @return Pheanstalk_Job
   */
  public static function getJob($tube)
  {
    $p = self::getInstance();
    return $p->watch($tube)->ignore('default')->reserve();
  }

  /**
   * @static
   * @param Pheanstalk_Job $job
   * @return Pheanstalk
   */
  public static function deleteJob(Pheanstalk_Job $job)
  {
    $p = self::getInstance();
    return $p->delete($job);
  }
}

