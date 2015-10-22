<?php
return [
    'title' => 'تنظیمات سیستم',
    'menu' => [
        'label' => 'تنظیمات سیستم',
        'url' => ['/setting/manage/index'],
        'icon' => 'cogs',
        'visible' =>  Yii::$app->user->canAccessAny(['superuser'])
    ],
    'components' => [
    ],
    'params' => [
    ],
];
