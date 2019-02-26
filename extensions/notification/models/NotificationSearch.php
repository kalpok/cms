<?php

namespace extensions\notification\models;

use yii\data\ActiveDataProvider;

class NotificationSearch extends Notification
{
    public function rules()
    {
        return [
            [['title', 'category', 'description'], 'string']
        ];
    }

    public function search($params)
    {
        $query = Notification::find()->addOrderBy('read, createdAt DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'createdAt'
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'category', $this->category]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
