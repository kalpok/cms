<?php
use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use kalpok\helpers\Utility;
use yii\bootstrap\ActiveForm;

$this->title = 'تنظیمات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-form">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'setting-form']); ?>
                <?php Panel::begin(
                    [
                        'title' => 'تنظیمات عمومی'
                    ]
                ); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['website.maintenanceMode'],
                                "[website.maintenanceMode]value"
                            )->dropDownList(['در دسترس', 'غیر فعال'])
                            ->label($settings['website.maintenanceMode']->getLabel())
                            ->hint('سایت در حالت غیر فعال از دسترس کاربران خارج می شود.');
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
                            echo $form->field(
                                $settings['website.timezone'],
                                "[website.timezone]value"
                            )->dropDownList(
                                array_combine($timezones, $timezones),
                                ['class' => 'form-control input-medium']
                            )->label($settings['website.timezone']->getLabel());
                        ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['website.deactiveUser'],
                                "[website.deactiveUser]value"
                            )->checkbox(['id'=>'deactive-user'])
                            ->label($settings['website.deactiveUser']->getLabel());
                        ?>
                    </div>
                    <div id="failed-login-attempts" class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['website.failedLoginAttempts'],
                                "[website.failedLoginAttempts]value"
                            )->dropDownList(
                                Utility::listNumbers(3, 10),
                                ['class' => 'form-control input-medium']
                            )->label($settings['website.failedLoginAttempts']->getLabel());
                        ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['website.cache'],
                                "[website.cache]value"
                            )->dropDownList(['غیر فعال', 'فعال'])
                            ->label($settings['website.cache']->getLabel());
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?= Button::widget(
                            [
                                'label' => 'ریست کش سیستم',
                                'type' => 'danger',
                                'icon' => false,
                                'url' => ['reset-cache'],
                                'visible' => Yii::$app->setting->get(
                                    'website.cache'
                                ),
                                'options' => [
                                    'style' => 'position:relative; top:25px'
                                ],
                            ]
                        ) ?>
                    </div>
                </div>
                <?php Panel::end() ?>
                <?php Panel::begin(
                    [
                        'title' => 'تنظیمات ایمیل'
                    ]
                ); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.senderEmail'],
                                "[email.senderEmail]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.senderEmail']->getLabel());
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.senderName'],
                                "[email.senderName]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.senderName']->getLabel());
                        ?>
                    </div>
                </div>
                <div>
                    <?php
                        echo $form->field(
                            $settings['email.protocol'],
                            "[email.protocol]value"
                        )->dropDownList(
                            [
                                'smtp' => 'smtp',
                                'php' => 'php mail',
                            ],
                            [
                                'id'=>'email-type',
                                'class' => 'form-control input-small'
                            ]
                        )->label($settings['email.protocol']->getLabel());
                    ?>
                </div>
                <div class="row smtp-part">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.smtpServer'],
                                "[email.smtpServer]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.smtpServer']->getLabel());
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.smtpPort'],
                                "[email.smtpPort]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.smtpPort']->getLabel());
                        ?>
                    </div>
                </div>
                <div class="row smtp-part">
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.smtpUsername'],
                                "[email.smtpUsername]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.smtpUsername']->getLabel());
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                            echo $form->field(
                                $settings['email.smtpPassword'],
                                "[email.smtpPassword]value"
                            )->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-medium'
                                ]
                            )->label($settings['email.smtpPassword']->getLabel());
                        ?>
                    </div>
                </div>

                <?php Panel::end();?>
                <?php Panel::begin(
                    [
                        'title' => 'گوگل آنالیتیکز'
                    ]
                ); ?>
                <div class="row">
                        <div class="col-md-8">
                            <?php echo $field = $form->field(
                                    $settings['website.googleAnalytics'],
                                    "[website.googleAnalytics]value"
                                )->textInput(
                                    [
                                        'class' => 'form-control input-large',
                                        'style' => 'direction:ltr',
                                        'placeholder' => 'UA-XXXXX-X'
                                    ]
                                )->label($settings['website.googleAnalytics']->getLabel());
                            ?>
                        </div>
                    </div>
                <?php Panel::end();?>
                <div class="form-group">
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-lg btn-success']
                    ) ?>
                    <?= Button::widget(
                        [
                            'label' => 'انصراف',
                            'options' => ['class' => 'btn-lg btn-flat margin'],
                            'type' => 'warning',
                            'icon' => 'undo',
                            'url' => ['/site/index'],
                        ]
                    ) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerJs(
    'if (!$("#deactive-user").is(":checked")) {
        $("#failed-login-attempts").hide();
    }
    $("#deactive-user").click(function () {
        $("#failed-login-attempts").toggle(this.checked);
    });
    if ($( "#email-type :selected" ).val()== \'php\') {
        $(".smtp-part").hide();
    }
    $("#email-type").on( "change", function() {
        if ($("#email-type :selected").text() == \'smtp\') {
            $(".smtp-part").show("slow");
        }
        else{
            $(".smtp-part").hide("slow");
        }
    });'
);
?>
