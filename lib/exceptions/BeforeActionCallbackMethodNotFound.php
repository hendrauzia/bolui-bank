<?php
/**
 * Exception for before_action callback method not found error.
 */
class BeforeActionCallbackMethodNotFound extends Exception
{
  /**
   * Redefine the exception so message isn't optional.
   *
   * @param string $calback_name Callback name
   * @param string $route Route in format 'controller#action'
   * @param int $code Error code for the exception
   * @param Exception $previous Previous nested exception
   *
   * @return void
   */
  public function __construct($callback_name, $route, $code = 0, Exception $previous = null) {
    $message = 'Before action callback "' . $callback_name . '" not found on route "' . $route . '"';
    parent::__construct($message, $code, $previous);
  }
}
