<?php
namespace modules\user\backend\models;

class ProfileField extends \modules\user\common\models\ProfileField
{
    public function rules()
    {
        return [
            [['label', 'type'], 'required'],
            [['type', 'priority'], 'integer'],
            ['label', 'string'],
        ];
    }
}
