<?php

namespace extensions\notification\channels;

use Yii;
use extensions\notification\Channel;
use extensions\notification\Notification;

class ScreenChannel extends Channel
{
    public function send(Notification $notification)
    {
        $className = $notification->className();
        foreach ($notification->getRecipients() as $recipient) {
            $rows[] = [
                'title' => $notification->getTitle(),
                'category' => $notification->getCategory(),
                'description' => $notification->getDescription(),
                'route' => serialize($notification->getRoute()),
                'class' => strtolower(
                    preg_replace(
                        '%([a-z])([A-Z])%',
                        '\1-\2',
                        substr($className, strrpos($className, '\\') + 1, -12)
                    )
                ),
                'module' => $notification->getModule(),
                'userId' => $recipient->id,
                'createdAt' => time()
            ];
        }
        Yii::$app->db->createCommand()->batchInsert(
            'notification',
            ['title', 'category', 'description', 'route', 'class', 'module', 'userId', 'createdAt'],
            $rows
        )->execute();
    }
}
