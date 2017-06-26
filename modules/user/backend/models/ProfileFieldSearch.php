<?php
namespace modules\user\backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProfileFieldSearch extends ProfileField
{
    public function rules()
    {
        return [
            [['id', 'type', 'priority'], 'integer'],
            [['label', 'language'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ProfileField::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
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
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'type' => $this->type,
            'priority' => $this->priority
        ]);
        $query->andFilterWhere(['like', 'label', $this->label]);
        $query->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
