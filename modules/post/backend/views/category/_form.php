<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use themes\admin360\widgets\editor\Editor;
use extensions\i18n\widgets\LanguageSelect;

?>

<div class="post-category-form">
    <?php Panel::begin([
        'title' => 'اطلاعات دسته'
    ]) ?>
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'options' => [
                'class' => 'sliding-form'
            ]
        ]) ?>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'title')
                    ->textInput(
                        [
                            'maxlength' => 255,
                            'class' => 'form-control input-large'
                        ]
                    )
                ?>
                <?= $form->field($model, 'description')
                    ->widget(
                        Editor::className(),
                        ['preset' => 'advanced']
                    )
                ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin() ?>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    ) ?>
                    <?= Button::widget([
                            'label' => 'انصراف',
                            'options' => ['class' => 'btn-lg close-sliding-form-button'],
                            'type' => 'warning',
                            'icon' => 'undo'
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
                            )->label(false) ?>
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
                    'title' => 'ویژگی ها'
                ]) ?>
                    <?= $form->field($model, 'isActive')->checkbox() ?>
                <?php Panel::end() ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>
