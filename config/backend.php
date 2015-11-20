<?php
return [
    'bootstrap' => [
        'kalpok\i18n\LanguageAndCalendarSetter'
    ],
    'aliases' => [
        '@webroot' => '@app/web/admin',
    ],
    'components' => [
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
        ],
        'user' => [
            'class' => 'modules\user\common\components\User'
        ],
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
