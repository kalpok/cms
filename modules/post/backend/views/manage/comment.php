<?php

use theme\widgets\Panel;
use modules\post\backend\models\Post;

$this->title = 'مدیریت نظرات';
$this->params['breadcrumbs'] = [
    ['label' => 'نوشته ها', 'url' => ['index']],
    $this->title
];

?>

<div class="sliding-form-wrapper"></div>
<?php Panel::begin(['title' => $this->title]) ?>
    <?= $this->render('@extensions/comment/views/grid.php', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'ownerPersianName' => 'نوشته',
        'ownerClassName' => Post::class
    ]) ?>
<?php Panel::end() ?>
