<?php
// INFO: define constants to be used accross application 
define('ROOT', dirname(__FILE__) . '/');
define('APP', ROOT . 'app/');
define('LIB', ROOT . 'lib/');
define('CONTROLLERS', APP . 'controllers/');
define('VIEWS', APP . 'views/');
define('EXCEPTIONS', LIB . 'exceptions/');

// INFO: autoload files safely
spl_autoload_register(function($class){
  $file_name = $class . '.php';

  if (file_exists(LIB . $file_name)) require_once LIB . $file_name;
  if (file_exists(EXCEPTIONS . $file_name)) require_once EXCEPTIONS . $file_name;
  if (file_exists(CONTROLLERS . $file_name)) require_once CONTROLLERS . $file_name;
});

Router::dispatch();