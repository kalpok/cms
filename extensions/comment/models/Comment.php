<?php

namespace extensions\comment\models;

use Yii;
use yii\helpers\Url;
use core\behaviors\TimestampBehavior;
use extensions\comment\behaviors\NotificationBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Comment extends \yii\db\ActiveRecord
{
    public $badge;
    public $verifyCode;

    const STATUS_PENDING = 1;
    const STATUS_REJECTED = 2;
    const STATUS_ACCEPTED = 3;
    const EVENT_COMMENT_INSERTED = 'commentInserted';

    public function behaviors()
    {
        return [
            'Timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'insertedAt',
                'updatedAtAttribute' => false
            ],
            'Notification' => [
                'class' => NotificationBehavior::class
            ]
        ];
    }

    public function rules()
    {
        return [
            ['content', 'required'],
            ['status', 'integer'],
            [
                ['content', 'reply', 'inserterName', 'inserterEmail'],
                'string'
            ],
            [['content', 'reply'], FarsiCharactersValidator::class],
            [['inserterName', 'inserterEmail'], 'required', 'when' => function ($model) {
                return $model->isNewRecord && !isset(Yii::$app->user->id);
            }],
            [['inserterName', 'inserterEmail'], 'trim'],
            [['inserterName', 'inserterEmail'], 'default', 'value' => null],
            ['inserterEmail', 'email'],
            [
                'verifyCode',
                'captcha',
                'captchaAction' => Url::to(['captcha']),
                'when' => function ($model) {
                    return $model->isNewRecord && !isset(Yii::$app->user->id);
                }
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'content' => 'نظر',
            'insertedBy' => 'درج کننده',
            'inserterName' => 'نام درج کننده',
            'inserterEmail' => 'ایمیل درج کننده',
            'inserterIp' => 'آی پی درج کننده',
            'insertedAt' => 'تاریخ درج نظر',
            'reply' => 'پاسخ',
            'repliedBy' => 'پاسخ دهنده',
            'repliedAt' => 'تاریخ درج پاسخ',
            'status' => 'وضعیت',
            'ownerId' => 'شناسه'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->inserterIp = Yii::$app->request->userIP;
            if (!Yii::$app->user->isGuest) {
                $this->insertedBy = Yii::$app->user->id;
            }
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->trigger(self::EVENT_COMMENT_INSERTED);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function fields()
    {
        return [
            'id',
            'content',
            'inserterName',
            'inserterEmail',
            'insertedAt',
            'reply',
            'repliedAt',
            'badge'
        ];
    }

    public static function tableName()
    {
        return 'comment';
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_PENDING => 'درحال بررسی',
            self::STATUS_REJECTED => 'تایید نشده',
            self::STATUS_ACCEPTED => 'تایید شده'
        ];
    }

    public static function getPendingCommentsCount($moduleId, $ownerClassName)
    {
        return self::find()
            ->andWhere([
                'status' => self::STATUS_PENDING,
                'moduleId' => $moduleId,
                'ownerClassName' => (new \ReflectionClass($ownerClassName))
                    ->getShortName()
            ])
        ->count();
    }
}
