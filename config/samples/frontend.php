<?php
return [
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
            // uncomment if multilanguage:
            // 'class' => '\kalpok\i18n\MultiLanguageUrlManager',
        ]
    ],
    'modules' => [
    ]
];
