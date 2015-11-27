<?php 

use yii\helpers\Html;

 ?>
<?php foreach ($posts as $post): ?>
    <div class="img-hover">
        <a href="<?php echo Yii::$app->urlManager->createUrl(['post/front/view', 'slug' => $post->slug]) ?>">
            <?php if (!empty($post->getFile('image'))) {
                echo Html::img(
                    $post->getFile('image')->getUrl('news-home-thumb'), [
                        "alt" => $post->title,
                        // "preset" => "post-secondary",
                        'class' => 'img-responsive',
                    ]);
            }?>
        </a>

        <h4 class="text-right margin-top-20">
            <?php echo Html::a($post->title, ['post/front/view', 'slug' => $post->slug]) ?>
        </h4>
        <p class="text-right"><?php echo $post->summary ?></p>
        <ul class="text-right size-12 list-inline list-separator">
            <li>
                <i class="fa fa-calendar"></i> 
                <?php echo Yii::$app->formatter->asDate($post->createdAt); ?>
            </li>
        </ul>
    </div>
<?php endforeach ?>