<?php

if (isset(Yii::$app->params['setting-views'])) {
    foreach (Yii::$app->params['setting-views'] as $settingView) {
        echo $this->render($settingView, ['form' => $form, 'settings' => $settings]);
    }
}
