<?php
return [
    'title' => 'اسلایدر صفحه نخست',
    'menu' => [
        'label' => 'اسلایدر صفحه نخست',
        'icon' => 'image',
        'items' => [
            [
                'label' => 'سایت فارسی',
                'url' => ['/slider/manage/home-fa'],
                'visible' => Yii::$app->user->can('slider.manager')
            ],
            [
                'label' => 'سایت انگلیسی',
                'url' => ['/slider/manage/home-en'],
                'visible' => Yii::$app->i18n->isMultiLanguage() && Yii::$app->user->can('slider.manager')
            ]
        ]
    ]
];
