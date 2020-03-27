<?php

namespace extensions\comment\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use extensions\comment\models\Comment;
use core\controllers\AjaxAdminController;
use extensions\comment\models\CommentSearch;

class CommentController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Comment::class;
        $this->searchClass = CommentSearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['accept', 'reply', 'reject', 'delete'],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['captcha']
                        ]
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'reply' => ['post']
                    ]
                ],
                [
                    'class' => ContentNegotiator::class,
                    'only' => ['accept', 'reply', 'reject', 'delete'],
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON
                    ]
                ]
            ]
        );
    }

    public function actionAccept($id)
    {
        $comment = $this->findModel($id);
        $comment->status = Comment::STATUS_ACCEPTED;
        $comment->save(false);
        echo Json::encode([
            'status' => 'success',
            'message' => 'نظر مورد نظر با موفقیت تایید شد.'
        ]);
        exit;
    }

    public function actionReply($id)
    {
        $comment = $this->findModel($id);
        if ($comment->load(Yii::$app->request->post())) {
            $comment->repliedBy = Yii::$app->user->id;
            $comment->repliedAt = time();
            $comment->status = Comment::STATUS_ACCEPTED;
            if ($comment->save(false)) {
                echo Json::encode([
                    'status' => 'success',
                    'message' => 'پاسخ با موفقیت ثبت شد.'
                ]);
                exit;
            }
        }
        echo Json::encode([
            'status' => 'renderEmptyForm',
            'content' => $this->renderAjax(
                '@extensions/comment/views/reply.php',
                [
                    'comment' => $comment
                ]
            )
        ]);
        exit;
    }

    public function actionReject($id)
    {
        $comment = $this->findModel($id);
        $comment->status = Comment::STATUS_REJECTED;
        $comment->save(false);
        echo Json::encode([
            'status' => 'success',
            'message' => 'نظر مورد نظر با موفقیت به وضعیت تایید نشده بروزرسانی شد.'
        ]);
        exit;
    }
}
