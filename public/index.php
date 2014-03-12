<?php

// Set configurations based on environment
if (isset($_SERVER['DEVELOPMENT'])) {
    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG', true);

    // Specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 5);

    // Set environment variable
    $environment = 'development';
} else {
    // Set environment variable
    $environment = 'production';
}


// change the following paths if necessary
$yii    = dirname(__FILE__) . '/../framework/yii.php';
$config = dirname(__FILE__) . '/../protected/config/main.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

define('PUBLICDIR', dirname(__FILE__));

date_default_timezone_set('UTC');
require_once($yii);
Yii::createWebApplication($config)->run();
