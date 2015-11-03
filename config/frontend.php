<?php
return [
    'on beforeAction' => function ($event) {
        kalpok\i18n\LanguageAndCalendarSetter::set();
    },
    'aliases' => [
        '@webroot' => '@app/web',
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'page/<id:\d+>' => 'page/front/view'
            ]
        ]
    ],
    'modules' => [
        'page' => 'modules\page\frontend\Module',
    ],
    'params' => [
        'app' => 'frontend',
    ]
];
