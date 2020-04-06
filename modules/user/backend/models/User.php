<?php

namespace modules\user\backend\models;

use Yii;
use modules\user\common\models\User as BaseUser;

class User extends BaseUser
{
    public function rules()
    {
        return [
            [['email', 'name', 'surname', 'identityCode'], 'trim'],
            ['email', 'email'],
            [['status', 'type'], 'integer'],
            ['phone', 'string', 'max' => 11, 'min' => 4],
            [
                'phone',
                'match',
                'pattern' => '([0-9]{4,11})',
                'message' => 'لطفا شماره را به طور صحیح وارد کنید.'

            ],
            [['email', 'name', 'surname', 'identityCode'], 'string', 'max' => 255],
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['changePassword'] = ['password'];
        $scenarios['update'] = ['email', 'status', 'type', 'phone', 'name', 'surname'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'email' => 'ایمیل',
            'phone' => 'شماره تماس',
            'name' => 'نام',
            'title' => 'نام',
            'surname' => 'نام خانوادگی',
            'identityCode' => 'ایمیل',
            'status' => 'وضعیت',
            'type' => 'نوع کاربر',
            'password' => 'کلمه عبور',
            'createdAt' => 'تاریخ ثبت‌نام',
            'updatedAt' => 'تاریخ آخرین بروزرسانی',
            'lastLoggedInAt' => 'تاریخ آخرین ورود',
            'failedAttempts' => 'دفعات تلاش ناموفق برای ورود'
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function afterDelete()
    {
        Yii::$app->db->createCommand()->delete('auth_assignment', [
            'user_id' => $this->id
        ])->execute();
        parent::afterDelete();
    }

    public static function statusLabels()
    {
        return [
            self::STATUS_ACTIVE => 'فعال',
            self::STATUS_BANNED => 'مسدود',
            self::STATUS_NOT_ACTIVE => 'غیر فعال'
        ];
    }

    public function getStatusLabel()
    {
        $labels = static::statusLabels();
        return $labels[$this->status];
    }

    public static function typeLabels()
    {
        return [
            self::TYPE_REGULAR => 'کاربر عادی',
            self::TYPE_OPERATOR => 'اپراتور',
            self::TYPE_EDITOR => 'سردبیر',
            self::TYPE_SUPERUSER => 'مدیر اصلی',
        ];
    }

    public static function adminTypeLabels()
    {
        return [
            self::TYPE_OPERATOR => 'اپراتور',
            self::TYPE_SUPERUSER => 'مدیر اصلی'
        ];
    }

    public function getTypeLabel()
    {
        $labels = static::typeLabels();
        return $labels[$this->type];
    }
}
