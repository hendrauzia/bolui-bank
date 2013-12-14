<?php
class Database
{
  /**
   * Connect to database using configuration in config/database.json
   *
   * @return void
   */
  public static function connect()
  {
    $config = json_decode(file_get_contents(CONFIG . 'database.json'));
    mysql_connect($config->host, $config->user, $config->password);
    mysql_select_db($config->database);
  }
}
