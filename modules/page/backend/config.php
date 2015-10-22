<?php
return [
    'title' => 'ماژول صفحات استاتیک',
    'menu' => [
        'label' => 'صفحات استاتیک',
        'icon' => 'file',
        'items' => [
            [
                'label' => 'صفحه جدید',
                'url' => ['/page/manage/create'],
                'visible' => Yii::$app->user->canAccessAny(['page.create'])
            ],
            [
                'label' => 'لیست صفحات',
                'url' => ['/page/manage/index'],
                'visible' =>  Yii::$app->user->canAccessAny(['page.create','page.update','page.delete'])
            ]
        ]
    ]
];
