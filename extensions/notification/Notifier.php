<?php

namespace extensions\notification;

use Yii;
use yii\base\InvalidParamException;

class Notifier extends \yii\base\Component
{
    public $channels = [];

    public function send($notification, array $channels = null)
    {
        if ($channels === null) {
            $channels = $notification->channels;
        }
        foreach ((array)$channels as $id => $config) {
            if (is_string($config)) {
                $channel = $this->getChannel($config);
            } else {
                $channel = $this->getChannel($id, $config);
            }
            if (!$notification->shouldSend($channel)) {
                continue;
            }
            $handle = 'to' . ucfirst($id);
            try {
                if ($notification->hasMethod($handle)) {
                    call_user_func([clone $notification, $handle], $channel);
                } else {
                    $channel->send(clone $notification);
                }
            } catch (\Exception $e) {
                Yii::warning(
                    "Notification sent by channel '$id' has failed: " . $e->getMessage(),
                    __METHOD__
                );
            }
        }
    }

    public function getChannel($id, $config = [])
    {
        if (!isset($this->channels[$id])) {
            throw new InvalidParamException("Unknown channel '{$id}'.");
        }
        return $this->createChannel(
            $id,
            array_merge($this->channels[$id], $config)
        );
    }

    protected function createChannel($id, $config)
    {
        return Yii::createObject($config, [$id]);
    }
}
