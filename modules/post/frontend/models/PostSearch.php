<?php

namespace modules\post\frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\post\frontend\models\Post;

/**
 * PostSearch represents the model behind the search form about `modules\post\frontend\models\Post`.
 */
class PostSearch extends Post
{
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'isActive' => $this->isActive,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
