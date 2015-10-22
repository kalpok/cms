<?php
return [
    'controllerMap' => [
        'site' => 'app\controllers\FrontendController',
    ],
    'aliases' => [
        '@webroot' => '@app/web',
    ],
    'components' => [
        'view' => [
            'theme' => [
                'basePath' => '@themes/kalpok',
                'pathMap' => [
                    '@app/views' => '@themes/kalpok/views',
                    '@modules' => '@themes/kalpok/views/modules',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ]
    ],
    'modules' => [
    ],
    'params' => [
        'application' => 'frontend',
    ]
];
