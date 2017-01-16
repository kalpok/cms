<?php
namespace core\behaviors;

use creocoder\taggable\TaggableQueryBehavior;

class CategoryQueryBehavior extends TaggableQueryBehavior
{
    public function hasAnyCategory($values, $attributes = null)
    {
        return $this->anyTagValues($values, $attributes = null);
    }

    public function hasAllCategories($values, $attributes = null)
    {
        return $this->allTagValues($values, $attributes = null);
    }

    public function relatedByCategories($values, $attributes = null)
    {
        return $this->relatedByTagValues($values, $attributes = null);
    }
}
