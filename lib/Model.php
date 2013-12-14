<?php
class Model
{
  /**
   * Check if provided param exists in database.
   *
   * @param mixed[] $param Uses format ['key' => 'value', 'key' => 'value']
   *
   * @return bool
   *
   * @todo protect against sql injection
   */
  public static function is_exists($param)
  {
    $condition = "";

    // TODO: protect against sql injection
    foreach ($param as $key => $value) $condition .= $key . " = " . "'" . $value . "'" . " AND ";
    $condition = substr($condition, 0, -4);

    $query = "SELECT * FROM " . static::TABLE . " WHERE $condition";
    $result = mysql_query($query);
    $num = mysql_num_rows($result);

    return ($num)? true : false;
  }
}
