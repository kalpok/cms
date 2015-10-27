<?php
return [
    'aliases' => [
        '@webroot' => '@app/web',
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ]
    ],
    'modules' => [
    ],
    'params' => [
        'app' => 'frontend',
    ]
];
