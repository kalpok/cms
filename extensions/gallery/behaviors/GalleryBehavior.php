<?php
namespace extensions\gallery\behaviors;

use yii;
use yii\db\ActiveRecord;
use extensions\gallery\models\Gallery;

class GalleryBehavior extends \yii\base\Behavior
{
    public $galleryAttribute = 'galleryId';
    private $gallery;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteGalleryAfterDeletion'
        ];
    }

    public function createGallery()
    {
        if ($this->hasGallery()) {
            return $this->getGallery();
        }
        $gallery = new Gallery;
        $gallery->owner = $this->owner->className();
        $gallery->save();
        $this->owner->{$this->galleryAttribute} = $gallery->id;
        $this->owner->save(false);
        return $gallery;
    }

    public function deleteGallery()
    {
        $gallery = $this->getGallery();
        $this->owner->{$this->galleryAttribute} = null;
        $this->owner->save(false);
        $gallery->delete();
        $this->gallery = null;
    }

    public function hasGallery()
    {
        return empty($this->getGallery()) ? false : true;
    }

    public function getGalleryImages()
    {
        if (!$this->hasGallery()) {
            return [];
        }

        return $this->getGallery()->images;
    }

    public function getGallery()
    {
        if (!isset($this->gallery)) {
            $this->gallery = Gallery::findOne($this->owner->{$this->galleryAttribute});
        }
        return $this->gallery;
    }

    public function deleteGalleryAfterDeletion()
    {
        !$this->hasGallery() ? : $this->getGallery()->delete();
    }
}
