<?php

namespace extensions\comment\notifications;

use extensions\notification\Notification;

class CommentInsertedNotification extends Notification
{
    public $comment;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "نظر جدیدی برای {$this->getOwnerTitle()} ثبت شد.";
    }

    public function getRoute()
    {
        return [
            "/{$this->comment->moduleId}/manage/comment",
            'CommentSearch[ownerId]' => $this->comment->ownerId
        ];
    }

    private function getOwnerTitle()
    {
        $ownerClassName = "modules\\{$this->comment->moduleId}\\frontend\\models\\{$this->comment->ownerClassName}";
        return $ownerClassName::findOne($this->comment->ownerId)->title;
    }
}
