<?php
class Controller
{

  /**
   * Layout file to be used for controller.
   *
   * @var string Layout name without extension.
   */
  protected $layout;

  /**
   * Callback methods to be called before actions.
   *
   * @var array Array of string.
   */
  private $before_action_callbacks;

  /**
   * Variable to store action name to be rendered.
   *
   * @var string 
   */
  private $action;

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
    // INFO: store action name to be rendered.
    $this->action = $name;

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
   * @throws LayoutNotFound if layout file defined in controller doesn't exists.
   *
   * @return void
   */
  private function render()
  {
    // INFO: render layout only if defined
    if ($this->layout) {
      $layout_view_path = LAYOUTS . $this->layout . '.php';

      // INFO: throws error if layout doesn't exists
      if (file_exists($layout_view_path)) {
        include $layout_view_path;
      } else {
        throw new LayoutNotFound($this->layout, Router::current_route());
      }
    } else {
      // INFO: render content only if layout is not defined
      $this->content();
    }
  }

  /**
   * Render action view content.
   *
   * @throws ViewNotFound if action view file is not found.
   *
   * @return void 
   */
  private function content()
  {
    $action_view_path = $this->action_view_path();
    if (file_exists($action_view_path)) {
      include $action_view_path;
    } else {
      throw new ViewNotFound(Router::current_route());
    }
  }

  /**
   * Get view folder path of controller.
   *
   * @return string Absolute view folder path of controller.
   */
  private function controller_view_path()
  {
    $prefix = strstr(get_class($this), __CLASS__, true);
    return VIEWS . strtolower($prefix) . '/';
  }

  /**
   * Get view file path of action.
   *
   * @return string Absolute view file path of action.
   */
  private function action_view_path()
  {
    // WARNING: 'neu' only used in function name, view name uses 'new'.
    if ($this->action == 'neu') $this->action = 'new';
    return $this->controller_view_path() . $this->action . '.php';
  }
}
