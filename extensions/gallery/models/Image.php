<?php
namespace extensions\gallery\models;

use Yii;
use extensions\file\behaviors\FileBehavior;

class Image extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'gallery_image';
    }

    public function behaviors()
    {
        return [
            [
                'class' => FileBehavior::className(),
                'groups' => [
                    'gallery_image' => [
                        'type' => FileBehavior::TYPE_IMAGE,
                        'rules' => [
                            'extensions' => ['png', 'jpg', 'jpeg'],
                            'maxSize' => 2*1024*1024,
                            'required' => true
                        ]
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            ['link', 'url'],
            [['galleryId'], 'required'],
            [['description', 'order'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'description' => 'شرح',
            'link' => 'آدرس اینترنتی',
            'order' => 'ترتیب'
        ];
    }

    public function getUrl($preset)
    {
        $imgFile = $this->getFile('gallery_image');
        if (null == $imgFile) {
            return '#';
        }

        return $imgFile->getUrl($preset);
    }
}
