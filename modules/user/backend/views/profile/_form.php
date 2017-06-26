<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use extensions\i18n\widgets\LanguageSelect;
use modules\user\backend\models\ProfileField;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="profile-form">
    <?php
    $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
            'id' => 'profile-form',
        ]
    );
    ?>
    <div class="row">
        <div class="col-md-8">
        <?php Panel::begin([
            'title' => 'تنظیمات فیلد',
            'options' => ['class' => 'panel-primary'],
        ]) ?>
            <?= $form->field($model, 'label')
                ->textInput(['class' => 'form-control input-medium']) ?>
            <?= $form->field($model, 'type')
                ->dropDownList(
                    ProfileField::typeLabels(),
                    ['class' => 'form-control input-small']
                )
            ?>
            <?= $form->field($model, 'priority')
                ->textInput(['class' => 'form-control input-medium'])
            ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ])?>

                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            </div>
        <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
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
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
