<?php

namespace extensions\notification\channels;

use Yii;
use extensions\notification\Notification;
use extensions\notification\channels\Channel;

class ScreenChannel extends Channel
{
    public function send(Notification $notification)
    {
        $className = $notification->className();
        $configTemplate = [
            'title' => $notification->title,
            'category' => $notification->category,
            'description' => $notification->description,
            'route' => serialize($notification->route),
            'data' => json_encode($notification->data),
            'class' => strtolower(
                preg_replace(
                    '%([a-z])([A-Z])%',
                    '\1-\2',
                    substr($className, strrpos($className, '\\') + 1, -12)
                )
            ),
            'moduleId' => $notification->moduleId,
            'userId' => null,
            'createdAt' => time()
        ];
        if (is_array($notification->recipients) and !empty($notification->recipients)) {
            $notifications = array_map(function($recipient) use ($configTemplate) {
                $configTemplate['userId'] = $recipient->id;
                return $configTemplate;
            }, $notification->recipients);
        } else {
            $notifications = [$configTemplate];
        }
        Yii::$app->db->createCommand()->batchInsert(
            'notification',
            ['title', 'category', 'description', 'route', 'data', 'class', 'moduleId', 'userId', 'createdAt'],
            $notifications
        )->execute();
    }
}
