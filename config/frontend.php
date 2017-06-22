<?php
return [
    'on beforeAction' => function ($event) {
        extensions\i18n\LanguageAndCalendarSetter::set();
    },
    'components' => [
        'view' => [
            'class' => 'extensions\i18n\View'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'page/<slug>' => 'page/front/view',
                'post/<slug>' => 'post/front/view',
                'category/<slug>' => 'post/front/category'
            ]
        ]
    ],
    'modules' => [
        'page' => 'modules\page\frontend\Module',
        'post' => 'modules\post\frontend\Module',
        'user' => 'modules\user\frontend\Module',
    ],
    'params' => [
        'app' => 'frontend',
    ]
];
