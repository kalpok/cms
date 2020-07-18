<?php

use theme\widgets\Panel;

?>

<?php Panel::begin(['title' => 'تنظیمات سئو']) ?>
    <div class="row">
        <div class="col-md-7">
            <?= $form->field(
                $settings['website.metaKeywords'],
                "[website.metaKeywords]value"
            )->textInput(
                [
                    'class' => 'form-control input-xlarge',
                    'placeholder' => 'کلید واژه‌ها را با , از هم جدا کنید.'
                ]
            )
            ->label($settings['website.metaKeywords']->getLabel()) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field(
                $settings['website.imageUrl'],
                "[website.imageUrl]value"
            )->textInput(
                [
                    'class' => 'form-control input-xlarge',
                    'placeholder' => 'یک URL معتبر برای عکس شاخص سایت وارد نمایی.'
                ]
            )->label($settings['website.imageUrl']->getLabel()) ?>
        </div>
    </div>
    <?= $form->field(
        $settings['website.metaDescription'],
        "[website.metaDescription]value"
    )->textarea(
        [
            'class' => 'form-control input-large',
            'rows' => '5'
        ]
    )->label($settings['website.metaDescription']->getLabel()) ?>
<?php Panel::end() ?>
