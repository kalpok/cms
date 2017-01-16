<?php
use yii\web\View;
use yii\helpers\Html;

$hasError = $fileObject->hasErrors() ? 'has-error' : '';
?>
<?= Html::activeInput('hidden', $fileObject, "[{$uniqueId}]group") ?>
<?= Html::activeInput('hidden', $fileObject, "[{$uniqueId}]folderName") ?>
<?= Html::input('hidden', 'delete-url', \yii\helpers\Url::toRoute('/file/ajax-delete')) ?>

<div class="form-group filemanager-widgets-file <?php echo $hasError ?>">
    <?php if (isset($this->context->label)): ?>
        <label class="control-label"><?php echo $this->context->label ?></label>
    <?php endif ?>
    <div class="single-file-upload" style="display:<?php echo $inputDisplay ?>">
        <span class="file-input btn btn-block btn-primary btn-image">
            انتخاب عکس
            <?= Html::activeFileInput(
                $fileObject,
                "[{$uniqueId}]resource",
                ['id'=>'file-input-'.$uniqueId]
            ) ?>
        </span>
        <img
            id="uploaded-image-<?= $uniqueId ?>"
            src="#"
            alt=""
            style="display:none"
            class="thumbnail image-preview" />
        <?= Html::error($fileObject, 'resource', ['class' => 'help-block']) ?>
    </div>
    <div class="uploaded-images">
        <ul class="list-group">
            <?php foreach ($uploadedImages as $image): ?>
                <li class="list-group-item">
                    <div class="image-thumb">
                        <?php echo Html::img(
                            $image->getUrl('form-upload')
                        ) ?>
                        <i
                            class="fa fa-times-circle fa-lg text-danger file-delete"
                            data-id="<?php echo $image->id ?>"
                        ></i>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
