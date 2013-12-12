<?php
class Controller
{
  /**
   * Triggered when invoking inaccessible method in an object context.
   *
   * This is used to wrap and call controller action, therefore all controller 
   * action must be declared as protected.
   *
   * @param string $name Method name
   * @param mixed[] $arguments Method arguments in array
   *
   * @return void
   */
  public function __call($name, $arguments) {
    $this->$name($arguments);
    $this->render($name);
  }

  /**
   * Render action view.
   *
   * Render the view of provided action in controller.
   *
   * @param string $name Action name
   *
   * @return void
   *
   * @todo Wrap view in application layout.
   */
  private function render($name)
  {
    $prefix = strstr(get_class($this), __CLASS__, true);
    $controller_view_path = VIEWS . strtolower($prefix) . '/';
    $action_view_path = $controller_view_path . $name . '.php';

    // TODO: Wrap view in application layout.
    if (file_exists($action_view_path)) {
      include $action_view_path;
    } else {
      throw new ViewNotFound(Router::currentRoute());
    }
  }
}
