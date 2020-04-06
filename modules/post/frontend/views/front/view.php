<?php

use yii\helpers\Html;

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label'=>'همه پست‌ها', 'url'=>['/post/front/index']];
$this->params['breadcrumbs'][] = ['label'=>$post->title, 'url'=>['/post/front/view', 'slug' => $post->slug]];
?>

<hr>
<p><i class="fa fa-clock-o"></i> Posted on <?php echo Yii::$app->formatter->asDate($post->createdAt); ?></p>
<hr>
<?php 
echo Html::img(
    $post->getFile('image')->getUrl('post-secondary'), 
    [
        "alt" => $post->title,
        // "preset" => "post-secondary",
        'class' => 'img-responsive',
    ]
) ?>

<hr>
<p class="lead"><?php echo $post->summary ?></p>
<?php echo $post->content ?>
<hr>