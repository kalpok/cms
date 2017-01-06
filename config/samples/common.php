<?php
return [
    'components' => [
        'request' => [
            'cookieValidationKey' => '',
        ],
        'i18n' => [
            // uncomment if multilanguage:
            // 'languages' => ['fa', 'en']
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
    ]
];
