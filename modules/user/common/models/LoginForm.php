<?php
namespace modules\user\common\models;

use Yii;
use yii\base\Model;
use modules\user\common\components\UserIdentity;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'آدرس ایمیل',
            'password' => 'رمز عبور',
            'rememberMe' => 'مرا به خاطر بسپار'
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'رمز عبور یا نام کاربری نامعتبر است.');
            } elseif (!$user->validatePassword($this->password)) {
                $user->updateFailedAttempts();
                $this->addError($attribute, 'رمز عبور یا نام کاربری نامعتبر است.');
            } elseif ($user->status == UserIdentity::STATUS_BANNED) {
                $this->addError($attribute, 'حساب کاربری شما مسدود شده است');
            } elseif ($user->status == UserIdentity::STATUS_NOT_ACTIVE) {
                $this->addError($attribute, 'حساب کاربری شما فعال نیست. با مدیر سیستم تماس بگیرید.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 14 : 0);
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserIdentity::findByEmail($this->username);
        }

        return $this->_user;
    }
}
