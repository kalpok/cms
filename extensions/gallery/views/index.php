<?php

use yii\helpers\Url;
use theme\widgets\ActionButtons;

?>

<div class="gallery-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'عکس جدید',
                'url' => ['/gallery/add-image', 'galleryId' => $gallery->id],
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'gallery-grid',
                    'data-modalheader' => 'عکس جدید',
                    'data-modalfooterbtns' => 'true'
                ]
            ],
            'undo' => [
                'label' => 'بازگشت',
                'icon' => 'undo',
                'type' => 'info',
                'url' => [
                    'view',
                    'id' => $ownerId,
                ],
                'visible' => isset($ownerId)
            ],
            'delete' => [
                'label' => 'حذف گالری',
                'url' => [
                    '/gallery/delete',
                    'id' => $gallery->id,
                    'ownerId' => $ownerId,
                    'returnUrl' => urlencode(Url::toRoute(['view', 'id' => $ownerId]))
                ],
                'visible' => isset($ownerId),
                'options' => [
                    'data' => [
                        'method' => 'post',
                        'confirm' => "آیا از حذف گالری مطمئن هستید؟ \n با این کار همه عکس ها نیز حذف خواهند شد.",
                    ]
                ]
            ]
        ]
    ]) ?>
    <?= $this->render('_grid', ['gallery' => $gallery]) ?>
</div>

