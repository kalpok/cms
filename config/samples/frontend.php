<?php
return [
    // uncomment if multilanguage:
    // 'on beforeAction' => function ($event) {
    //     kalpok\i18n\LanguageAndCalendarSetter::set();
    // },
    // uncomment if UNI language:
    // 'bootstrap' => [
    //     'kalpok\i18n\LanguageAndCalendarSetter'
    // ],
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
