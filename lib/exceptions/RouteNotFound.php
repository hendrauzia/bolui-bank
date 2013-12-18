<?php
/**
 * Exception for route not found error.
 */
class RouteNotFound extends Exception
{
  /**
   * Redefine the exception so message isn't optional.
   *
   * @param string $route Route in format 'controller#action'
   * @param int $code Error code for the exception
   * @param Exception $previous Previous nested exception
   *
   * @return void
   */
  public function __construct($route, $code = 0, Exception $previous = null) {
    $message = 'Route "' . $route . '" not found';
    parent::__construct($message, $code, $previous);
  }
}
