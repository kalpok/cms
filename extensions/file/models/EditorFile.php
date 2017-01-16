<?php
namespace extensions\file\models;

use yii;

class EditorFile extends File
{
    public function init()
    {
        $this->group = 'editor';
        $this->isImage = false;
        return true;
    }

    public function rules()
    {
        return [
            [
                'resource',
                'file',
                'extensions' =>
                    [
                        'pdf', 'zip',
                        'doc', 'docx',
                        'ppt', 'pptx',
                        'xls', 'xlsx',
                        'jpg', 'jpeg',
                        'png', 'gif'
                    ],
                'maxSize' => 10*1024*1024 //10 MB
            ]
        ];
    }

    public function getErrorsAsString()
    {
        return implode(', ', $this->getErrors('resource'));
    }

    protected function getWebsiteId()
    {
        return Yii::$app->user->activeWebsite->id;
    }

    protected function getUrlManager()
    {
        return Yii::$app->frontendUrlManager;
    }

    protected function requestingWebsiteName()
    {
        return Yii::$app->user->activeWebsite->subdomain;
    }
}
