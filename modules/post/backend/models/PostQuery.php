<?php
namespace modules\post\backend\models;

class PostQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            'core\behaviors\CategoryQueryBehavior'
        ];
    }
}
