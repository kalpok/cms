<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\post\frontend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'اخبار', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="blog-post-title"><?= Html::encode($this->title) ?></h1>
    <ul class="blog-post-info list-inline">
        <li>
            <a href="#">
                <i class="fa fa-clock-o"></i> 
                <span class="font-lato"><?php echo Yii::$app->formatter->asDate($model->createdAt); ?></span>
            </a>
        </li>
        <li>
            <i class="fa fa-folder-open-o"></i> 
            <?php foreach ($model->categories as $category): ?>
                <?php echo Html::a('<span class="font-lato">'.$category->title.'</span>', ['/post/front/category', 'slug' => $category->slug], ['class' => "category"]); ?>
            <?php endforeach ?>
        </li>
    </ul>

    <div class="blog-single-small-media inverse"><!-- .inverse = right position (left on RTL) -->

        <!-- IMAGE -->
        
        <figure>
            <?php if (!empty($model->getFile('image'))) {
                echo Html::img(
                    $model->getFile('image')->getUrl('post-primary'), [
                        "alt" => $model->title,
                        // "preset" => "post-secondary",
                        'class' => 'img-responsive',
                    ]);
            }?>
        </figure>
        
        <!-- /IMAGE -->

        <!-- VIDEO -->
        <!--
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="http://player.vimeo.com/video/8408210" width="800" height="450"></iframe>
        </div>
        -->
        <!-- /VIDEO -->

        <!-- 
            CAPTIONS:
            
            AVAILABLE CLASSES
            
            .caption-light
            .caption-dark

            .caption-primary
            .caption-default    (optional: .noborder-top , .noborder-bottom)
            .caption-warning
            .caption-danger
            .caption-info
        -->
        <!-- <div class="caption-light">
            <?php echo $model->summary; ?>
        </div> -->
    </div>

    <?php echo $model->content ?>

    <div style="clear: both;"></div>
    <div class="divider divider-dotted"><!-- divider --></div>

    <!-- SHARE POST -->
    <div class="clearfix margin-top-30">

        <span class="pull-left margin-top-6 bold hidden-xs">
            Share Post: 
        </span>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-right" data-toggle="tooltip" data-placement="top" title="Facebook">
            <i class="icon-facebook"></i>
            <i class="icon-facebook"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-twitter pull-right" data-toggle="tooltip" data-placement="top" title="Twitter">
            <i class="icon-twitter"></i>
            <i class="icon-twitter"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-right" data-toggle="tooltip" data-placement="top" title="Google plus">
            <i class="icon-gplus"></i>
            <i class="icon-gplus"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-right" data-toggle="tooltip" data-placement="top" title="Linkedin">
            <i class="icon-linkedin"></i>
            <i class="icon-linkedin"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-pinterest pull-right" data-toggle="tooltip" data-placement="top" title="Pinterest">
            <i class="icon-pinterest"></i>
            <i class="icon-pinterest"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-call pull-right" data-toggle="tooltip" data-placement="top" title="Email">
            <i class="icon-email3"></i>
            <i class="icon-email3"></i>
        </a>

    </div>
    <!-- /SHARE POST -->

</div>
