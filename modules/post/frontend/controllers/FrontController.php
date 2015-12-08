<?php

namespace modules\post\frontend\controllers;

use Yii;
use yii\web\Controller; 
use yii\web\NotFoundHttpException;
use modules\post\frontend\models\Post;
use modules\post\frontend\models\PostSearch;
use modules\post\frontend\models\Category;
use yii\data\ActiveDataProvider;

/**
 * FrontController implements the CRUD actions for Post model.
 */
class FrontController extends Controller
{
    public $layout = '//two-column';

    public function actionIndex()
    {
        $post = Post::find()
            ->andWhere('isActive = 1')
            ->addOrderBy('priority DESC')
            ->addOrderBy('createdAt DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $post,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        $post = Post::find()
            ->where(['slug'=>$slug])
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
        $post = Post::find()
            ->joinWith('categories')
            ->andWhere('categoryId = '.$category->id)
            ->addOrderBy('priority DESC')
            ->addOrderBy('createdAt DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $post,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
