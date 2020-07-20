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
            // these will get reversed in final config array
            'rules' => [
                '<module>/category/<slug>' => '<module>/front/category',
                '<module>/<slug>' => '<module>/front/view',
                '<module>/<id:\d+>/<title>' => '<module>/front/view',
                '<module>/<id:\d+>' => '<module>/front/view',
                '<module>/<id:\d+>/<slug>' => '<module>/front/view',
                '<module>' => '<module>/front/index',
                'file/download/<name>' => 'file/serve-file',
                'file/serve-image' => 'file/serve-image',
                '' => 'site/index',
                'post/archive/<year>/<month>' => 'post/front/archive', // each module shoul feed for it
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
