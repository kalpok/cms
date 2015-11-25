<?php

namespace modules\post\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\post\backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `modules\post\backend\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isActive'], 'integer'],
            [['title', 'language', 'categories'], 'safe'],
        ];
    }

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
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'language', $this->language]);
        if (!empty($this->categories)) {
            $query->hasAnyCategory($this->categories);
        }
        return $dataProvider;
    }
}
