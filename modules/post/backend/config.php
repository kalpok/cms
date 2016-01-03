<?php
return [
    'title' => 'نوشته‌ها',
    'menu' => [
        'label' => 'نوشته‌ها',
        'icon' => 'pencil',
        'items' => [
            [
                'label' => 'همه نوشته‌ها',
                'url' => ['/post/manage/index'],
                'visible' =>  Yii::$app->user->canAccessAny(['post.create','post.update','post.delete'])
            ],
            [
                'label' => 'افزودن نوشته',
                'url' => ['/post/manage/create'],
                'visible' => Yii::$app->user->canAccessAny(['post.create'])
            ],
            [
                'label' => 'دسته‌ها',
                'url' => ['/post/category/index'],
                'visible' => Yii::$app->user->canAccessAny(['post.categories'])
            ],
        ]
    ]
];
