<?php
return [
    'bootstrap' => [
        'extensions\i18n\LanguageAndCalendarSetter'
    ],
    'aliases' => [
        '@themes' => '@app/themes',
        '@theme' => '@themes/admin360',
    ],
    'controllerMap' => [
        'gallery' => 'extensions\gallery\controllers\GalleryController'
    ],
    'components' => [
        'view' => [
            'theme' => [
                'basePath' => '@theme',
                'pathMap' => [
                    '@app/views' => '@theme/views',
                    '@modules' => '@theme/views/modules',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'file/download/<name>' => 'file/serve-file'
            ]
        ],
        'frontendUrlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'baseUrl' => '/'
        ]
    ],
    'modules' => [
        'page' => 'modules\page\backend\Module',
        'post' => 'modules\post\backend\Module',
        'user' => 'modules\user\backend\Module',
        'setting' => 'modules\setting\Module'
    ],
    'params' => [
        'app' => 'backend',
    ]
];
