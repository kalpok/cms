<?php

namespace extensions\notification\models;

use Yii;
use yii\helpers\ArrayHelper;

class Notification extends \yii\db\ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'category' => 'دسته',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ'
        ];
    }

    public static function find()
    {
        return parent::find()->andWhere(['userId' => Yii::$app->user->id]);
    }

    public static function getUnreadNotificationsCountForUser()
    {
        return self::find()->andWhere(['read' => false])->count();
    }

    public static function getCategories()
    {
        return array_unique(
            ArrayHelper::getColumn(self::find()->all(), 'category')
        );
    }

    public static function tableName()
    {
        return 'notification';
    }
}
