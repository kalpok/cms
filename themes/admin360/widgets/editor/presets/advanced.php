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
                'Image', '-',
                'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list',
                    'indent', 'blocks', 'align', 'bidi', '-',
                'Table', '-',
                'Bold', 'Italic', '-',
                'TextColor', 'BGColor', '-'

            ],
        ],
        [
            'name' => 'row2',
            'items' => [
                'Link', 'Unlink', 'Anchor', '-',
                'FontSize', '-',
                'Blockquote', '-','Format'
            ],
        ],
    ]
];
