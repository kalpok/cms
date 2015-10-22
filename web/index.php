<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
require(dirname(__FILE__).'/../helpers/globals.php');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$application = 'frontend';
$config = require(__DIR__ . '/../config/merge-configs.php');

$application = new yii\web\Application($config);
$application->run();
