<?php
return [
    'title' => 'ماژول برگه ها',
    'menu' => [
        'label' => 'برگه ها',
        'icon' => 'file',
        'items' => [
            [
                'label' => 'برگه جدید',
                'url' => ['/page/manage/create'],
                'visible' => Yii::$app->user->canAccessAny(['page.create'])
            ],
            [
                'label' => 'لیست برگه ها',
                'url' => ['/page/manage/index'],
                'visible' =>  Yii::$app->user->canAccessAny(['page.create','page.update','page.delete'])
            ]
        ]
    ]
];
