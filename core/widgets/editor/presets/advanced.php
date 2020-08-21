<?php

return [
    'height' => 300,
    'removeButtons' => 'Smiley,Iframe',
    'toolbar' => [
        [
            'name' => 'row1',
            'items' => [
                'Source', '-',
                "Undo","Redo",'-',
                "PasteText","PasteFromWord",'-',
                "Maximize",'-',
                'NumberedList', 'BulletedList', '-',
                'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                '-', 'BidiRtl', 'BidiLtr', '-',
            ],
        ],
        [
            'name' => 'row2',
            'items' => [
                'Image', '-',
                'Link', 'Unlink', 'Anchor', '-',
                'Table', '-',
                'FontSize', '-',
                'Bold', 'Italic', '-',
                'TextColor', 'BGColor', '-',
                'Blockquote', '-','Format'
            ],
        ],
    ]
];
