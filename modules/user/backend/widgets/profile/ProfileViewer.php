<?php

namespace modules\user\backend\widgets\profile;

class ProfileViewer extends \yii\base\Widget
{
    public $userId;
    public $viewName;

    public function run()
    {
        return $this->render($this->viewName);
    }
}
