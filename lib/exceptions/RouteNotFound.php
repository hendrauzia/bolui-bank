<?php
/**
 * Exception for route not found error.
 */
class RouteNotFound extends Exception
{
  /**
   * Redefine the exception so message isn't optional.
   *
   * @param string $route Route generated from Router::currentRoute()
   * @param int $code Error code for the exception
   * @param Exception $previous Previous nested exception
   *
   * @see Router::currentRoute() for how routes are generated.
   *
   * @return void
   */
  public function __construct($route, $code = 0, Exception $previous = null) {
    $message = 'Route not found for "' . $route . '"';
    parent::__construct($message, $code, $previous);
  }
}
