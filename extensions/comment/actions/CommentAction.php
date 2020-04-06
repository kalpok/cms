<?php

namespace extensions\comment\actions;

use Yii;
use yii\base\InvalidConfigException;
use yii\web\ServerErrorHttpException;
use extensions\comment\models\Comment;

class CommentAction extends \yii\base\Action
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

    public function run($ownerId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $comment = new Comment([
            'moduleId' => $this->moduleId,
            'ownerId' => $ownerId,
            'ownerClassName' => (new \ReflectionClass($this->ownerClassName))
                ->getShortName()
        ]);
        $comment->load(Yii::$app->getRequest()->getBodyParams());
        if ($comment->save()) {
            Yii::$app->getResponse()
                ->setStatusCode(201)
                ->data = [
                    'message' => 'نظر شما با موفقیت ثبت شد، پس از تایید در سایت نمایش داده خواهد شد.'
                ];
        } elseif ($comment->hasErrors()) {
            Yii::$app->getResponse()
                ->setStatusCode(422)
                ->data = $comment->errors;
        } else {
            throw new ServerErrorHttpException('Failed to add comment for unknown reason.');
        }
    }
}
