<?php

namespace extensions\comment\actions;

use Yii;
use yii\base\InvalidConfigException;
use extensions\comment\models\CommentSearch;

class IndexAction extends \yii\base\Action
{
    public $moduleId;
    public $ownerClassName;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if (empty($this->ownerClassName)) {
            throw new InvalidConfigException('ownerClassName property must be set.');
        }
        parent::init();
    }

    public function run()
    {
        $searchModel = new CommentSearch();
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['moduleId'] = $this->moduleId;
        $params[$searchModel->formName()]['ownerClassName'] =
            (new \ReflectionClass($this->ownerClassName))->getShortName();
        return $this->controller->render('comment', [
            'searchModel' => $searchModel,
            'dataProvider' => $searchModel->search($params)
        ]);
    }
}
