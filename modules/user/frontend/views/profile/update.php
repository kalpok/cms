<?php
use yii\helpers\Html;
use yii\web\View;

$this->title = 'پروفایل';
$this->params['breadcrumbs'] = [
    $this->title,
];
?>
<table class="table table-bordered table-hover">
  <tbody>
    <?php foreach ($user->profile as $data) : ?>
        <tr>
            <th class="col-xs-3"><?= $data->field->label ?></th>
            <td><?= $data->data ?></td>
        </tr>
    <?php endforeach ?>
  </tbody>
</table>
