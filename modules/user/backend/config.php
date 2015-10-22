<?php
return [
    'title' => 'مدیریت کاربران',
    'components' => [
        // list of component configurations
    ],
    'params' => [
        // list of parameters
    ],
    'menu' =>[
        'label' => 'مدیریت کاربران',
        'url' => ['/user/manage/index'],
        'icon' => 'user',
        'visible' => Yii::$app->user->can('superuser')
    ]
];
