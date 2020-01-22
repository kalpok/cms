<?php
namespace extensions\gallery\models;

use Yii;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\base\InvalidCallException;

class Gallery extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    public function rules()
    {
        return [
            ['handle', 'unique'],
        ];
    }

    public static function find()
    {
        $query = new ActiveQuery(get_called_class());
        $query->with('images');
        return $query;
    }

    public function search()
    {
        $query = Image::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'order' => SORT_ASC,
                ],
            ],
        ]);
        $query->andFilterWhere([
            'galleryId' => $this->id
        ]);

        return $dataProvider;
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['galleryId' => 'id'])
            ->orderBy(['order' => SORT_ASC]);
    }

    public static function loadByHandle($handle)
    {
        return Gallery::find()->where(['handle' => $handle])->one();
    }

    public static function createForHandle($handle)
    {
        $gallery = new Gallery(['handle' => $handle]);
        return $gallery->save() ? $gallery : false;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            foreach ($this->images as $image) {
                $image->delete();
            }
            return true;
        }
        return false;
    }
}
