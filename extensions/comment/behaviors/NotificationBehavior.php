<?php

namespace extensions\comment\behaviors;

use extensions\comment\models\Comment;
use extensions\comment\notifications\CommentInsertedNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Comment::EVENT_COMMENT_INSERTED => 'commentInserted'
        ];
    }

    public function commentInserted()
    {
        CommentInsertedNotification::create([
            'moduleId' => $this->owner->moduleId,
            'comment' => $this->owner,
            'permissions' => ["{$this->owner->moduleId}.comment"]
        ])->send();
    }
}
