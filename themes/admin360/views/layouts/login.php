<?php
use yii\helpers\Html;
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
    <div id="alerts-area">
        <?php echo FlashMessage::widget(['alertClass' => 'alert-fixed-top']); ?>
    </div>
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				<?= $content ?>
            </div>
        </div>
    </div>
</body>
<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
