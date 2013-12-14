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
    // INFO: connect provided database.
    Database::connect();

    // INFO: dispatch router for current request.
    Router::dispatch();
  }
}
