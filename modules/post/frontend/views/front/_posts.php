<?php
use yii\helpers\Html;
?>
<!-- POST ITEM -->
<div class="blog-post-item"><!-- .blog-post-item-inverse = image right side [left on RTL] -->

    <!-- IMAGE -->
    <figure class="blog-item-small-image margin-bottom-20">
        <?php if (!empty($model->getFile('image'))) {
            echo Html::img(
                $model->getFile('image')->getUrl('post-secondary'), [
                    "alt" => $model->title,
                    // "preset" => "post-secondary",
                    'class' => 'img-responsive',
                ]);
        }?>
    </figure>

    <div class="blog-item-small-content">

        <h2><?php echo Html::a($model->title, ['/post/front/view', 'slug' => $model->slug]); ?></h2>

        <ul class="blog-post-info list-inline">
            <li>
                <a href="#">
                    <i class="fa fa-clock-o"></i> 
                    <span class="font-lato"><?php echo Yii::$app->formatter->asDate($model->createdAt); ?></span>
                </a>
            </li>
        </ul>

        <p>
            <?php echo $model->summary; ?>
        </p>

        <?php echo Html::a('<i class="fa fa-plus"></i> <span>Read More</span>',
            ['/post/front/view', 'slug' => $model->slug],
            ['class' => "btn btn-reveal btn-default"]) ?>
    </div>

</div>
<!-- /POST ITEM --> 