<?php
namespace core\widgets;

use Yii;
use yii\web\View;
use yii\base\Widget;
use yii\bootstrap\Alert;

class FlashMessage extends Widget
{
    public $alertClass;
    public function run()
    {
        foreach (Yii::$app->session->getAllFlashes() as $type => $message) {
            if (!in_array($type, ['success', 'danger', 'error', 'warning', 'info'])) {
                $type = 'info';
            }
            $alertType = 'alert-'.$type;
            if (is_array($message)) {
                $message = array_pop($message);
            }
            echo Alert::widget([
                'options' => ['class' => "alert {$alertType} {$this->alertClass}"],
                'body' => $message,
            ]);
        }
    }
}
?>

