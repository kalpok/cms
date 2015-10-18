<?php
use yii\helpers\ArrayHelper;

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common.php'),
    require(__DIR__ . '/' . $application . '.php'),
    require(__DIR__ . '/local/common.php'),
    require(__DIR__ . '/local/' . $application . '.php')
);

return $config;
