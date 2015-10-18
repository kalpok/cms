<?php
use core\widgets\Panel;
use core\widgets\Button;
use core\widgets\ActionButtons;

$this->title = 'داشبورد';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim']]) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim']]) ?>

        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim'], 'type' => 'default']) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim'], 'type' => 'default']) ?>

        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim'], 'type' => 'primary']) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim'], 'type' => 'primary']) ?>

        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim'], 'type' => 'info']) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim'], 'type' => 'info']) ?>

        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim'], 'type' => 'warning']) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim'], 'type' => 'warning']) ?>

        <?php echo Button::widget(['options' => ['class' => 'btn-lg btn-outline dim'], 'type' => 'danger']) ?>
        <?php echo Button::widget(['options' => ['class' => 'btn-lg dim'], 'type' => 'danger']) ?>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-sm-12">
        <?php echo ActionButtons::widget([
                    'modelID' => 10,
                    'buttons' => [
                        'create' => [],
                        'update' => [],
                        'delete' => []
                    ]
                ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل ساده',
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل primary',
            'options' => ['class' => 'panel-primary'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل success',
            'options' => ['class' => 'panel-success'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل info',
            'options' => ['class' => 'panel-info'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل warning',
            'options' => ['class' => 'panel-warning'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل danger',
            'options' => ['class' => 'panel-danger'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل green',
            'options' => ['class' => 'panel-green'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل yellow',
            'options' => ['class' => 'panel-yellow'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
    <div class="col-sm-4">
        <?php Panel::begin([
            'title' => 'پنل red',
            'options' => ['class' => 'panel-red'],
            'footer' => 'panel footer',
        ]) ?>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
        <?php Panel::end() ?>
    </div>
</div>
