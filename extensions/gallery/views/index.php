<?php

use yii\helpers\Url;
use themes\admin360\widgets\Button;

?>
<div class="gallery-index">
    <?= Button::widget([
        'label' => 'عکس جدید',
        'icon' => 'plus',
        'type' => 'success',
        'url' => ['/gallery/add-image', 'galleryId' => $gallery->id],
        'options' => [
            'class' => 'btn btn-app ajaxcreate',
            'data-gridpjaxid' => 'gallery-grid'
        ]
    ]) ?>

    <?php if (isset($ownerId)) {
        echo Button::widget([
            'label' => 'بازگشت',
            'icon' => 'undo',
            'type' => 'info',
            'url' => [
                'view',
                'id' => $ownerId,
            ],
            'options' => ['class' => 'btn btn-app']
        ]);

        echo Button::widget([
            'label' => 'حذف گالری',
            'icon' => 'trash',
            'type' => 'danger',
            'url' => [
                '/gallery/delete',
                'id' => $gallery->id,
                'ownerId' => $ownerId,
                'returnUrl' => urlencode(Url::toRoute(['view', 'id' => $ownerId]))
            ],
            'options' => [
                'class' => 'btn btn-app',
                'data' => [
                    'method' => 'post',
                    'confirm' => "آیا از حذف گالری مطمئن هستید؟ \n با این کار همه عکس ها نیز حذف خواهند شد.",
                ]
            ]
        ]);
    } ?>
    <div style="clear:both"></div>

    <div class="sliding-form-wrapper"></div>

    <div class="grid">
        <?= $this->render('_grid', ['gallery' => $gallery]) ?>
    </div>
</div>

