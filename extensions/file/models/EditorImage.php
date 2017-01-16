<?php
namespace extensions\file\models;

class EditorImage extends EditorFile
{
    public function init()
    {
        $this->group = 'editor';
        $this->isImage = true;
        return true;
    }

    public function rules()
    {
        return [
            [
                'resource',
                'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'maxSize' => 2*1024*1024 //2 MB
            ]
        ];
    }
}
