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
        'label' => 'کاربران',
        'icon' => 'user',
        'visible' => Yii::$app->user->can('superuser'),
        'items' => [
            [
                'label' => 'مدیریت کاربران',
                'url' => ['/user/manage/index'],
                'visible' =>  Yii::$app->user->canAccessAny(['user.create','user.update','user.delete'])
            ],
            [
                'label' => 'مدیریت فیلدهای پروفایل',
                'url' => ['/user/profile/index'],
                'visible' => Yii::$app->user->canAccessAny(['user.profile'])
            ],
        ]
    ]
];
