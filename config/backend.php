<?php
return [
    'aliases' => [
        '@webroot' => '@app/web/admin',
    ],
    'components' => [
        'view' => [
            'theme' => [
                'basePath' => '@themes/admin360',
                'pathMap' => [
                    '@app/views' => '@themes/admin360/views',
                    '@modules' => '@themes/admin360/views/modules',
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
        ],
        'user' => [
            'class' => 'modules\user\common\components\User'
        ],
    ],
    'modules' => [
        'page' => 'modules\page\backend\Module',
        'user' => 'modules\user\backend\Module',
        'setting' => 'modules\setting\Module'
    ],
    'params' => [
        'app' => 'backend',
    ]
];
