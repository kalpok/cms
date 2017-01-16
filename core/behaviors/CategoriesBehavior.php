<?php
namespace core\behaviors;

use creocoder\taggable\TaggableBehavior;

class CategoriesBehavior extends TaggableBehavior
{
    public $catRelation = 'cats';
    public $catValueAttribute = 'title';
    public $catValuesAsArray = false;
    public $catFrequencyAttribute = false;

    public function init()
    {
        parent::init();
        $this->tagValuesAsArray = $this->catValuesAsArray;
        $this->tagRelation = $this->catRelation;
        $this->tagValueAttribute = $this->catValueAttribute;
        $this->tagFrequencyAttribute = $this->catFrequencyAttribute;
    }

    public function getCategories()
    {
        return $this->getTagValues();
    }

    public function getCategoriesAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setCategories($values)
    {
        return $this->setTagValues($values);
    }

    public function addCategories($values)
    {
        return $this->addTagValues($values);
    }

    public function removeCategories($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllCategories()
    {
        return $this->removeAllTagValues();
    }

    public function hasCategories($values)
    {
        return $this->hasTagValues($values);
    }
}
