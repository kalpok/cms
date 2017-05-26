<?php
    use yii\helpers\Html;
?>
<ul>
<?php foreach ($posts as $post): ?>
    <li>
        <?= Html::a($post->title, ['post/front/view', 'slug' => $post->slug]) ?>
    </li>
<?php endforeach ?>
</ul>

<?php if (isset($category)): ?>
    <?= Html::a($category->title, ['post/front/category', 'slug' => $category->slug]) ?>
<?php endif ?>
