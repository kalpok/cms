<?php
$config = [
    'id' => 'kalpok',
    'language' => 'fa',
    'name' => 'kalpok cms',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@core' => '@app/core',
        '@config' => '@app/config',
        '@modules' => '@app/modules',
        '@extensions' => '@app/extensions'
    ],
    'controllerMap' => [
        'site' => 'core\controllers\SiteController',
        'file' => 'extensions\file\controllers\FileController'
    ],
    'bootstrap' => [
        'log',
        'modules\setting\components\SettingApplier',
    ],
    'components' => [
        'i18n' => [
            'class' => 'extensions\i18n\I18N',
            'translations' => [
                'theme' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@theme/messages',
                ]
            ],
        ],
        'formatter' => [
            'class' => 'extensions\i18n\Formatter',
            'dateFormat' => 'php:d F Y',
            'datetimeFormat' => 'php:d F Y | H:i',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'setting' => [
            'class' => 'modules\setting\components\Settings',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['superuser', 'editor', 'operator'],
            // 'cache' => 'cache'
        ],
        'mailer' => [
            'class' => 'extensions\mailer\Mailer',
            'useFileTransport' => false
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
            'class' => 'modules\user\common\components\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/auth/login'],
            'identityClass' => 'modules\user\common\components\UserIdentity'
        ]
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
