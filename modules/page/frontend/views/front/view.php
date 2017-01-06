<?php

use yii\helpers\Html;
use modules\page\frontend\widgets\pagefamily\PageFamily;
use kalpok\gallery\widgets\gallery\Gallery;

$this->params['title'] = $page->title;
$this->params['breadcrumbs'] = [
    $page->title,
];
$this->title = $page->title;
?>
<div class="page-view article-view">
    <article>
        <h1><?php echo $page->title ?></h1>
        <figure>
        <?php if (!empty($page->getFile('image'))) {
                 echo Html::img($page->getFile('image')->getUrl('page-image'), [
                    "class" => "img-responsive"]);
        } ?>
        </figure>
        <div class="content">
            <?= $page->content ?>
            <div style="clear:both;"></div>
            <?= Gallery::widget(
            [
                'view' => 'lightboxgallery',
                'images'=>$page->getGalleryImages(),
                'id' => 'hasan',
            ]
            ) ?>
        </div>
    </article>
</div>
<?php $this->beginBlock('sidebar');?>
    <?= PageFamily::widget([
            'page' => $page,
            'listClass' => 'list-unstyled',
            'showTitle' => false,
            'containerClass' => 'side-menu',
            // 'listIcon' => ''
        ]) ?>
<?php $this->endBlock() ?>
