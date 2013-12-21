<?php
/**
 * Exception for before_action callback method not found error.
 */
class LayoutNotFound extends Exception
{
  /**
   * Redefine the exception so message isn't optional.
   *
   * @param string $layout Layout name
   * @param string $route Route in format 'controller#action'
   * @param int $code Error code for the exception
   * @param Exception $previous Previous nested exception
   *
   * @return void
   */
  public function __construct($layout, $route, $code = 0, Exception $previous = null) {
    $message = 'Layout "' . $layout . '" not found on route "' . $route . '"';
    parent::__construct($message, $code, $previous);
  }
}
