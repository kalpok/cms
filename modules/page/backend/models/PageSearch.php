<?php
namespace modules\page\backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PageSearch extends Page
{
    public function rules()
    {
        return [
            [['id', 'isActive'], 'integer'],
            [['title', 'language'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Page::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'root' => SORT_DESC,
                    'lft' => SORT_ASC,
                ]
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'isActive' => $this->isActive
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'language', $this->language]);
        return $dataProvider;
    }
}
