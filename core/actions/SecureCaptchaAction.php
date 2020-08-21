<?php

namespace core\actions;

use Yii;
use yii\captcha\CaptchaAction;

class SecureCaptchaAction extends CaptchaAction
{
    public $testLimit = 1;
    public $minLength = 5;
    public $maxLength = 5;
    public $offset = 2;
    // public $fixedVerifyCode = (YII_ENV_DEV or YII_ENV_TEST) ? 'test' : null;

    public function run()
    {
        if (
            Yii::$app->request->isAjax &&
            Yii::$app->request->getQueryParam(self::REFRESH_GET_VAR) == null
        ) {
            if ($this->getVerifyCode() == Yii::$app->request->get('code')) {
                return $this->controller->asJson(['success' => true]);
            } else {
                $this->removeCodeFromSession();
                return $this->controller->asJson(['success' => false]);
            }
        }
        return parent::run();
    }

    protected function generateVerifyCode()
    {
        $this->minLength = $this->maxLength = 7;
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 20) {
            $this->maxLength = 20;
        }
        $length = mt_rand($this->minLength, $this->maxLength);

        $letters = '1bc2df3gh4jk5lm6np7qr8st9vwxyz';
        $vowels = 'aeiou';
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $vowels[mt_rand(0, 4)];
            } else {
                $code .= $letters[mt_rand(0, 29)];
            }
        }

        return $code;
    }

    protected function removeCodeFromSession()
    {
        Yii::$app->session->remove($this->getSessionKey());
    }
}
