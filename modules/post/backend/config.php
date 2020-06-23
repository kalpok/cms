<?php
return [
    'title' => 'نوشته ها',
    'menu' => [
        'label' => 'نوشته ها',
        'icon' => 'pencil',
        'items' => [
            [
                'label' => 'نوشته جدید',
                'url' => ['/post/manage/create'],
                'visible' => Yii::$app->user->canAccessAny(['post.create'])
            ],
            [
                'label' => 'لیست نوشته ها',
                'url' => ['/post/manage/index'],
                'visible' => Yii::$app->user->canAccessAny(['post.create', 'post.update', 'post.delete'])
            ],
            [
                'label' => 'دسته ها',
                'url' => ['/post/category/index'],
                'visible' => Yii::$app->user->canAccessAny(['post.categories'])
            ],
            'comments-link' => [
                'label' => 'نظرات',
                'url' => ['/post/manage/comment'],
                'visible' => Yii::$app->user->canAccessAny(['post.comment'])
            ],
        ]
    ]
];
