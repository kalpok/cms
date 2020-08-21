<?php

namespace core\widgets;

use yii\helpers\Url;
use yii\captcha\Captcha;

class SecureCaptchaWidget extends Captcha
{
    public function init()
    {
        $this->options = [
            'placeholder' => 'کد امنیتی',
            'class' => 'form-control',
            'style' => 'direction: ltr'
        ];
        $this->template = '
            <div class="row">
            <div class="">
                <div class="col-md-6">
                    <div class="input-group" style="border: 1px solid #EEEEEE; border-radius: 8px;">
                        <span id="captchaRefreshButton" class="input-group-addon" style="cursor:pointer">
                            <i class="glyphicon glyphicon-refresh refresh-captcha"></i>
                        </span>
                        {image}
                    </div>
                </div>
                <div class="col-md-6 p-t-1 captcha-input-wrapper">
                    {input}
                </div>
            </div>
            </div>
        ';
        parent::init();
    }

    public function registerClientScript()
    {
        parent::registerClientScript();
        $view = $this->getView();
        $fieldId = $this->options['id'];
        $validationUrl = Url::toRoute($this->captchaAction);
        $view->registerJs("
            $('#$fieldId').on('change.yii', function() {
                $.ajax({
                    url: '$validationUrl',
                    data: {code: $(this).val()},
                }).done(function(data) {
                    if(data.success) {
                        $('div.field-$fieldId').find('.help-block-error').html('');
                        $('div.field-$fieldId').removeClass('has-error');
                        $('div.field-$fieldId').addClass('has-success');
                    } else {
                        $('#{$this->imageOptions['id']}').trigger('click');
                        $('div.field-$fieldId').find('.help-block-error').html('" .
                            $this->model->getActiveValidators($this->attribute)[0]->message
                        . "');
                        $('div.field-$fieldId').removeClass('has-success');
                        $('div.field-$fieldId').addClass('has-error');
                    }
                })
            });
            $('#$fieldId').parent().parent().find('.refresh-captcha').parent().on('click', function(e) {
                $('#{$this->imageOptions['id']}').trigger('click');
            });
        ");
    }
}
