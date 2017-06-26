<?php

namespace modules\user\common\models;

use Yii;

class ProfileField extends \yii\db\ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_INTEGER = 2;
    const TYPE_DATE = 3;
    const TYPE_TEXT = 4;

    public static function tableName()
    {
        return 'user_profile_field';
    }

    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'language' => 'زبان',
            'label' => 'عنوان',
            'type' => 'نوع',
            'priority' => 'اولویت',
            'createdAt' => 'تاریخ ایجاد',
            'updatedAt' => 'تاریخ بروز رسانی',
        ];
    }
}
