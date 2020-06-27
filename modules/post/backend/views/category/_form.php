<?php

use theme\widgets\Panel;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use extensions\i18n\widgets\LanguageSelect;

?>

<div class="post-category-form">
    <?php Panel::begin() ?>
        <?php $form = ActiveForm::begin() ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?php if (Yii::$app->i18n->isMultiLanguage()): ?>
                        <?php Panel::begin(['title' => 'زبان']) ?>
                            <?php if ($model->isNewRecord): ?>
                                <?= $form->field($model, 'language')->widget(
                                    LanguageSelect::className(),
                                    ['options' => ['class' => 'form-control']]
                                )->label(false) ?>
                            <?php else: ?>
                                <?= $form->field($model, 'language')->textInput([
                                    'class' => 'form-control',
                                    'disabled' => true,
                                    'value' => Yii::$app->formatter->asLanguage($model->language)
                                ])->label(false) ?>
                            <?php endif ?>
                        <?php Panel::end() ?>
                    <?php endif ?>
                </div>
                <div class="col-md-6">
                    <br>
                    <?= $form->field($model, 'isActive')->checkbox() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->widget(
                        Editor::className(),
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>

<?php $this->registerJs('
    $(document).ready(function () {
        $(".modal-inner").trigger("pageReady");
    });
');
