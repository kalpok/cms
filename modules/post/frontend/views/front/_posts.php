<?php
use yii\helpers\Html;
?>
<h2><?php echo Html::a($model->title, ['/post/front/view', 'slug' => $model->slug]); ?></h2>
<p><i class="fa fa-clock-o"></i> Posted on <?php echo Yii::$app->formatter->asDate($model->createdAt); ?></p>
<hr>
<?php if (!empty($model->getFile('image'))): ?>
    <?php 
    echo Html::a(
        Html::img(
            $model->getFile('image')->getUrl('post-secondary'), 
            [
                "alt" => $model->title,
                // "preset" => "post-secondary",
                'class' => 'img-responsive img-hover',
            ]
        ), 
        [
            '/post/front/view',
            'slug' => $model->slug
        ]
    ); 
    ?>
<?php endif ?>
<hr>
<p><?php echo $model->summary; ?></p>
<?php 
echo Html::a(
    'Read More <i class="fa fa-angle-right"></i>',
    ['/post/front/view', 'slug' => $model->slug],
    ['class' => "btn btn-primary"]
) 
?>
<hr>