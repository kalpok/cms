<?php
namespace modules\user\common\widgets;

use Yii;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class ShowPassword extends InputWidget
{
    public function run()
    {
        echo '
        <div class="input-group input-medium show-password">';
            if ($this->hasModel()) {
                echo Html::activePasswordInput($this->model, $this->attribute, $this->options);
            } else {
                echo Html::passwordInput($this->name, $this->value, $this->options);
            }
            echo '
            <span class="input-group-btn">
                <button class="btn btn-default" style="margin-bottom: 5px; height: 34px;" type="button">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </button>
            </span>
        </div>';
        $this->registerClientScript();
    }

    private function registerClientScript()
    {
        $this->getView()->registerJs("$(document).ready( function() {
            $('.show-password .btn').on('click',function ()
            {
                if ($('.show-password input').attr('type') == 'text'){
                    var newtype = 'password';
                    var newIcon = 'glyphicon glyphicon-eye-open';
                }
                else{
                    var newtype = 'text';
                    var newIcon = 'glyphicon glyphicon-eye-close';
                }
                $('.show-password input').attr('type', newtype);
                $('.show-password .btn i').attr('class', newIcon)
            })
        });", View::POS_END, 'showPassword');
    }
}
