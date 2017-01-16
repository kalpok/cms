<?php
namespace extensions\i18n\validators;

use yii;
use yii\validators\Validator;
use kalpok\helpers\Utility;

class FarsiCharactersValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (
            $this->calledFromBackendAndNeedsConvert()
            or $this->calledFromFrontendAndNeedsConvert()
        ) {
            $model->$attribute = Yii::$app->i18n->convertArabicToFarsi(
                $model->$attribute
            );
        }
    }

    private function calledFromBackendAndNeedsConvert()
    {
        // TODO
        return Yii::$app->params['app'] == 'backend';
            // and Yii::$app->user->activeWebsite->language == 'fa';
    }

    private function calledFromFrontendAndNeedsConvert()
    {
        return Yii::$app->params['app'] == 'frontend'
            and Yii::$app->language == 'fa';
    }
}
