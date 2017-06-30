<?php

namespace modules\user\frontend\helpers;

use Yii;
use yii\helpers\Html;
use modules\user\common\models\ProfileField;

class FormBuilder
{
    public static function input($user, $field)
    {
        foreach ($user->profile as $userData) {
            if ($userData->profileFieldId == $field->id) {
                return self::field($userData, $field);
            }
        }
        return self::field(null, $field);
    }
    public static function field($profileData, $field)
    {
        if ((ProfileField::TYPE_STRING == $field->type) || (ProfileField::TYPE_INTEGER == $field->type) || (ProfileField::TYPE_DATE == $field->type)) {
            return self::textInput($profileData, $field);
        } elseif (ProfileField::TYPE_TEXT == $field->type) {
            return self::textarea($profileData, $field);
        }
    }

    public static function textInput($profileData, $field)
    {
        if (empty($profileData)) {
            return Html::textInput("data[".$field->id."][0]");
        } else {
            return Html::textInput("data[".$field->id."][".$profileData->id."]", $profileData->data);
        }
    }

    public static function textarea($profileData, $field)
    {
        if (empty($profileData)) {
            return Html::textarea("data[".$field->id."][0]");
        } else {
            return Html::textarea("data[".$field->id."][".$profileData->id."]", $profileData->data);
        }
    }
}
