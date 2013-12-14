<?php
class Application
{
  /**
   * Initialize application
   *
   * @return void
   */
  public static function initialize()
  {
    // INFO: dispatch router for current request.
    Router::dispatch();
  }
}
