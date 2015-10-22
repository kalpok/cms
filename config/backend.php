<?php
return [
    'controllerMap' => [
        'site' => 'app\controllers\BackendController',
    ],
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
        'page' => 'app\modules\page\backend\Module',
        'user' => 'app\modules\user\backend\Module',
        'setting' => 'app\modules\setting\Module'
    ],
    'params' => [
        'application' => 'backend',
    ]
];
