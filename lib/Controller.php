<?php
class Controller
{
  /**
   * Callback methods to be called before actions.
   *
   * @var array Array of string.
   */
  private $before_action_callbacks;

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
  public function __call($name, $arguments) 
  {
    // INFO: run before action callbacks methods.
    $this->run_before_action_callbacks();

    // INFO: call action.
    $this->$name($arguments);
    $this->render($name);
  /**
   * Add method to be called before action.
   *
   * @param string $method Method name to be called before action.
   *
   * @return void
   */
  protected function before_action($method)
  { 
    $this->before_action_callbacks[] = $method;
  }

  /**
   * Run methods assigned by before_action.
   *
   * @see Controller::before_action()
   *
   * @throws BeforeActionCallbackMethodNotFound if method assigned by before_action doesn't exists.
   *
   * @return void
   */
  private function run_before_action_callbacks()
  {
    if (count($this->before_action_callbacks)) {
      foreach ($this->before_action_callbacks as $callback) {
        if (method_exists($this, $callback)) {
          $this->$callback();
        } else {
          throw new BeforeActionCallbackMethodNotFound($callback, Router::current_route());
        }
      }
    }
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

    // WARNING: 'neu' only used in function name, view name uses 'new'.
    if ($name == 'neu') $name = 'new';
    $action_view_path = $controller_view_path . $name . '.php';

    // TODO: Wrap view in application layout.
    if (file_exists($action_view_path)) {
      include $action_view_path;
    } else {
      throw new ViewNotFound(Router::current_route());
    }
  }
}
