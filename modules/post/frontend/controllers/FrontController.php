<?php

namespace modules\post\frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use modules\post\frontend\models\Post;
use modules\post\frontend\models\Category;

class FrontController extends Controller
{
    public $layout = '//two-column';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->addOrderBy('createdAt DESC'),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        $post = Post::find()
            ->AndWhere(['slug'=>$slug])
            ->with('categories')
            ->one();
        if ($post == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('view', [
            'model' => $post,
        ]);
    }

    public function actionCategory($slug)
    {
        $category = Category::find()
            ->andWhere(['slug' => $slug])
            ->one();
        if ($category == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $category->getPosts(),
                'sort' => ['defaultOrder' => ['createdAt' => SORT_DESC]],
            ]
        );
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
