<?php

namespace extensions\comment\models;

use yii\data\ActiveDataProvider;

class CommentSearch extends Comment
{
    public $inserterMobile;

    public function rules()
    {
        return [
            [['insertedBy', 'status', 'ownerId'], 'integer'],
            [
                [
                    'inserterName',
                    'inserterEmail',
                    'inserterIp',
                    'moduleId',
                    'ownerClassName',
                    'content',
                    'reply',
                    'inserterMobile'
                ],
                'safe'
            ]
        ];
    }

    public function search($params)
    {
        $query = Comment::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'ownerId',
                    'insertedAt',
                    'repliedAt',
                    'status'
                ],
                'defaultOrder' => [
                    'insertedAt' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'comment.status' => $this->status,
            'comment.ownerId' => $this->ownerId
        ]);
        $query->andFilterWhere(['like', 'comment.inserterName', $this->inserterName])
            ->andFilterWhere(['like', 'comment.inserterEmail', $this->inserterEmail])
            ->andFilterWhere(['like', 'comment.inserterIp', $this->inserterIp])
            ->andFilterWhere(['like', 'comment.content', $this->content])
            ->andFilterWhere(['like', 'comment.reply', $this->reply])
            ->andFilterWhere(['comment.moduleId' => $this->moduleId])
            ->andFilterWhere(['comment.ownerClassName' => $this->ownerClassName]);

        if (!empty($this->inserterMobile)) {
            $query->innerJoin('user', 'user.id = comment.insertedBy')
                ->andWhere(['like', 'user.mobile', $this->inserterMobile]);
        }

        return $dataProvider;
    }
}
