<?php
namespace modules\post\backend\models;

use yii;
use kalpok\behaviors\CategoryQueryBehavior;

class PostQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            CategoryQueryBehavior::className(),
        ];
    }
}
