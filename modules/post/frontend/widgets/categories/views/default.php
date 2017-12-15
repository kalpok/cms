<?php
    use yii\helpers\Html;
?>
<div class="well">
    <h4><?= $this->context->title ?></h4>
    <div class="row">
        <div class="col-lg-12">
			<ul class="list-unstyled">
			<?php foreach ($categories as $category) : ?>
			    <li>
			        <?= Html::a($category->title, ['post/front/category', 'slug' => $category->slug]) ?>
			    </li>
			<?php endforeach ?>
			</ul>
        </div>
    </div>
</div>
