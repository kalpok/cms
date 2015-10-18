<?php
use yii\helpers\Url;
use yii\helpers\Html;
use core\widgets\Menu;
use yii\widgets\Breadcrumbs;
use core\widgets\FlashMessage;
use core\assetbundles\IEAssetBundle;
use themes\admin360\assetbundles\ThemeAssetBundle;

ThemeAssetBundle::register($this);
IEAssetBundle::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>
    <div id="wrapper">
        <?= $this->render('nav.php') ?>
        <div id="page-wrapper">
            <?= Breadcrumbs::widget([
                'tag' => 'ol',
                'homeLink' => [
                    'label' => 'خانه',
                    'url' => \yii::$app->homeUrl,
                    'template' => '<li><i class="fa fa-dashboard"></i> {link}</li>'
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="row">
                <div class="col-sm-12">
                    <div id="alerts-area">
                        <?php echo FlashMessage::widget(['alertClass' => 'alert-fixed-top']); ?>
                    </div>
                </div>
            </div>
            <?= $content ?>
        </div>
	</div>
</body>
<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
