<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use themes\admin360\widgets\editor\Editor;
use extensions\i18n\widgets\LanguageSelect;
use extensions\file\widgets\singleupload\SingleImageUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="page-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات برگه'
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
                            Select2::class,
                            [
                                'data' => $model->getParentsForSelect2(),
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
                <?= $form->field($model, 'summary')->textarea(['rows' => 4]) ?>
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
            <?php if (Yii::$app->i18n->isMultiLanguage()): ?>
                <?php Panel::begin([
                    'title' => 'زبان'
                ]) ?>
                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'language')->widget(
                            LanguageSelect::className(),
                            ['options' => ['class' => 'form-control input-large']]
                        )->label(false); ?>
                    <?php else: ?>
                        <?= $form->field($model, 'language')->textInput([
                            'class' => 'form-control input-large',
                            'disabled' => true,
                            'value' => Yii::$app->formatter->asLanguage($model->language)
                        ])->label(false) ?>
                    <?php endif ?>
                <?php Panel::end() ?>
            <?php endif ?>
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
                'title' => 'ویژگی های برگه'
            ]) ?>
                <?= $form->field($model, 'isActive')->checkbox(); ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
