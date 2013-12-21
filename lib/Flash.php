<?php
/**
 * This class is used as a flash notification to be displayed on next page.
 *
 * Notification is set on certain condition and displayed on next request where
 * it supposed to be displayed. After it has been displayed, it will be removed
 * immediately at the of the request.
 */
class Flash
{
  const KEY = 'flash';

  /**
   * Get flash notification using provided key.
   *
   * @param string $key Flash notification key, such as: notice, warning, or error.
   *
   * @return mixed Return string if exist, null if don't.
   */
  public static function get($key)
  {
    return $_SESSION[APP_NAME][self::KEY]['now'][$key] ?: null;
  }

  /**
   * Set flash notification to displayed on next page using provided key and value.
   *
   * @param string $key Flash notification key, such as: notice, warning, or error.
   * @param string $value Flash notification value.
   *
   * @return void
   */
  public static function set($key, $value)
  {
    $_SESSION[APP_NAME][self::KEY]['next'][$key] = $value;
  }

  /**
   * This is to be run at start of application.
   *
   * @return void
   */
  public static function cycle()
  {
    $_SESSION[APP_NAME][self::KEY]['now'] = $_SESSION[APP_NAME][self::KEY]['next'];
    unset($_SESSION[APP_NAME][self::KEY]['next']);
  }

  /**
   * This is to be run at the end of application.
   *
   * @return void
   */
  public static function flush()
  {
    unset($_SESSION[APP_NAME][self::KEY]['now']);
  }
}
