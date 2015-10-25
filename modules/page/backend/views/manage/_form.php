<?php

use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\editor\Editor;
use themes\admin360\widgets\SelectizeDropDownList;
use modules\page\backend\models\Page;
use kalpok\file\widgets\singleupload\SingleImageUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="page-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات صفحه'
            ]) ?>
                <?=
                    $form->field($model, 'title')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-large'
                            ]
                        )
                ?>
                <?=
                    $form->field($model, 'parentId')
                        ->widget(
                            SelectizeDropDownList::className(),
                            [
                                'allItems' => $model->possibleParents(),
                                'selectedItems' => $model->parentId,
                                'valueField' => 'id',
                                'labelField' => 'prefixedTitle',
                                'searchField' => ['prefixedTitle'],
                                'additionalItems' => [
                                    [
                                        'id' => 0,
                                        'prefixedTitle' => 'صفحه سطح نخست است'
                                    ]
                                ],
                                'options' => [
                                    'class' => 'form-control input-large'
                                ]
                            ]
                        );
                ?>
                <?=
                    $form->field($model, 'content')
                        ->widget(
                            Editor::className(),
                            ['preset' => 'advanced']
                        )
                ?>
            <?php Panel::end() ?>

            
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'تصویر شاخص'
            ]) ?>
                <?php
                    echo SingleImageUpload::widget(
                        [
                            'model' => $model,
                            'group' => 'image',
                        ]
                    );
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'ویژگی های صفحه'
            ]) ?>
                <?= $form->field($model, 'isActive')->checkbox(); ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
