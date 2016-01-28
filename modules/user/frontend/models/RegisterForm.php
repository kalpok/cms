<?php
namespace modules\user\frontend\models;

use Yii;
use yii\base\Model;
use modules\user\common\models\User;

class RegisterForm extends User
{
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'match',
                'pattern' => '((?=.*\d)(?=.*[a-zA-Z]).{6,20})',
                'message' => 'کلمه عبور باید شامل حروف و حداقل یک عدد یا سمبل دیگر باشد. '.
                             'طول کلمه عبور باید بین ۶ و ۲۰ کاراکتر باشد.',
            ],
            ['email', 'unique', 'message' => 'این آدرس ایمیل قبلا استفاده شده است.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'ایمیل',
            'password' => 'کلمه عبور',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->status = self::STATUS_ACTIVE;
            }
            return true;
        }
        return false;
    }
}