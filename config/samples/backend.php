<?php
return [
    'components' => [
        'view' => [
            'theme' => [
                'basePath' => '@themes/admin360',
                'pathMap' => [
                    '@app/views' => '@themes/admin360/views',
                    '@modules' => '@themes/admin360/views/modules',
                ],
            ],
        ]
    ],
    'modules' => [
    ]
];
