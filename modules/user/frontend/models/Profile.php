<?php
namespace modules\user\frontend\models;

class Profile extends \modules\user\common\models\ProfileData
{
    public function rules()
    {
        return [
            [['profileFieldId'], 'required'],
            [['profileFieldId'], 'integer'],
            ['data', 'string'],
        ];
    }
}
