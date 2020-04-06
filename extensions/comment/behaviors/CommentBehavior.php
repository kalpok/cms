<?php

namespace extensions\comment\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use extensions\comment\models\Comment;

class CommentBehavior extends \yii\base\Behavior
{
    public $moduleId;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteComments'
        ];
    }

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        parent::init();
    }

    public function getAcceptedComments()
    {
        return Comment::find()
            ->andWhere([
                'moduleId' => $this->moduleId,
                'ownerId' => $this->owner->id,
                'ownerClassName' => (new \ReflectionClass($this->owner))
                    ->getShortName(),
                'status' => Comment::STATUS_ACCEPTED
            ])
            ->orderBy(['insertedAt' => SORT_DESC])
            ->all();
    }

    public function deleteComments()
    {
        Yii::$app->db->createCommand()->delete('comment', [
            'moduleId' => $this->moduleId,
            'ownerId' => $this->owner->id,
            'ownerClassName' => (new \ReflectionClass($this->owner))
                ->getShortName()
        ])->execute();
    }
}
