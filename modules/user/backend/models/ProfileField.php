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

    public static function typeLabels()
    {
        return [
            self::TYPE_STRING => 'متن کوتاه',
            self::TYPE_INTEGER => 'عدد',
            self::TYPE_DATE => 'تاریخ',
            self::TYPE_TEXT => 'متن طولانی',
        ];
    }

    public function getTypeLabel()
    {
        $labels = static::typeLabels();
        return $labels[$this->type];
    }
}
