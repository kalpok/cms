<?php
use yii\web\View;
use yii\helpers\Html;
use modules\user\frontend\helpers\FormBuilder;

$this->title = 'ویرایش پروفایل';
$this->params['breadcrumbs'] = [
    $this->title,
];
?>
<?= Html::beginForm(); ?>
<table class="table table-bordered table-hover">
  <tbody>
    <?php foreach ($fields as $field) : ?>
        <tr>
            <th class="col-xs-3"><?= $field->label ?></th>
            <td><?= FormBuilder::input($user, $field) ?></td>
        </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div class="form-group">
    <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
        'class' => 'btn btn-lg btn-success'
    ])?>
</div>
<?= Html::endForm() ?>
