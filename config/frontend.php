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
                'file/serve-image' => 'file/serve-image',
                'file/download/<name>' => 'file/serve-file',
                '<module>' => '<module>/front/index',
                '<module>/<id:\d+>' => '<module>/front/view',
                '<module>/<id:\d+>/<title>' => '<module>/front/view',
                '<module>/<slug>' => '<module>/front/view',
                '<module>/category/<slug>' => '<module>/front/category',
            ]
        ]
    ],
    'modules' => [
        'page' => 'modules\page\frontend\Module',
        'post' => 'modules\post\frontend\Module',
    ],
    'params' => [
        'app' => 'frontend',
    ]
];
