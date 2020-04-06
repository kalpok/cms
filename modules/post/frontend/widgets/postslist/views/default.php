<?php
    use yii\helpers\Html;
?>
<div class="well">
    <h4><?= $this->context->title ?></h4>
    <div class="row">
        <div class="col-lg-12">
			<ul class="list-unstyled">
			<?php foreach ($posts as $post) : ?>
			    <li>
			        <?= Html::a($post->title, ['post/front/view', 'slug' => $post->slug]) ?>
			    </li>
			<?php endforeach ?>
			</ul>
			<?php if (isset($category)) : ?>
			    <?= Html::a($category->title, ['post/front/category', 'slug' => $category->slug], ['class' => 'btn btn-success']) ?>
			<?php endif ?>
        </div>
    </div>
</div>


