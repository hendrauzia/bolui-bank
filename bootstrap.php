<?php
session_start();

// INFO: define constants to be used accross application.
define('APP_NAME', 'bolui');

// INFO: define application paths constants.
define('ROOT', dirname(__FILE__) . '/');
define('APP', ROOT . 'app/');
define('CONFIG', ROOT . 'config/');
define('LIB', ROOT . 'lib/');
define('CONTROLLERS', APP . 'controllers/');
define('MODELS', APP . 'models/');
define('VIEWS', APP . 'views/');
define('LAYOUTS', VIEWS . 'layouts/');
define('EXCEPTIONS', LIB . 'exceptions/');

// INFO: autoload classes safely
spl_autoload_register(function($class){
  $file_name = $class . '.php';

  if (file_exists(LIB . $file_name)) require_once LIB . $file_name;
  if (file_exists(EXCEPTIONS . $file_name)) require_once EXCEPTIONS . $file_name;
  if (file_exists(CONTROLLERS . $file_name)) require_once CONTROLLERS . $file_name;
  if (file_exists(MODELS . $file_name)) require_once MODELS . $file_name;
});

// INFO: Initialize application
Application::initialize();
