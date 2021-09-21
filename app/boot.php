<?php
  require_once 'autoload.php';
  use Libraries\DotEnv;
  use Libraries\Route as App;
  
  define('APP', dirname(__FILE__));

  session_start();

  (new DotEnv(__DIR__ . '/../.env'))->load();
  new App();