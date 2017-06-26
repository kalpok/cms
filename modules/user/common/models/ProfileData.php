<?php

namespace modules\user\common\models;

use Yii;

class ProfileData extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user_profile_data';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'userId' => 'شناسه کاربر',
            'profileFieldId' => 'شناسه نوع فیلد',
            'data' => 'داده',
            'createdAt' => 'تاریخ ایجاد',
            'updatedAt' => 'تاریخ بروز رسانی',
        ];
    }

    public function getField()
    {
        return $this->hasOne(ProfileField::className(), ['id' => 'profileFieldId']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
