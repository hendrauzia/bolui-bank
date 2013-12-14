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
    // INFO: move next flash to current flash at start of request lifeycle.
    Flash::cycle();

    // INFO: connect provided database.
    Database::connect();

    // INFO: dispatch router for current request.
    Router::dispatch();

    // INFO: destroy current flash at end of request lifecycle.
    Flash::flush();
  }
}
