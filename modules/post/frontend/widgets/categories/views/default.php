<?php
    use yii\helpers\Html;
?>
<ul>
<?php foreach ($categories as $category) : ?>
    <li>
        <?= Html::a($category->title, ['post/front/category', 'slug' => $category->slug]) ?>
    </li>
<?php endforeach ?>
</ul>
