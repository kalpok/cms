<?php

namespace core\behaviors;

class NestedSetsBehavior extends \creocoder\nestedsets\NestedSetsBehavior
{
    private $parent;
    private $parentId;

    public function getNestedTitle()
    {
        $output = $this->owner->title;
        for ($i = 0; $i < $this->owner->depth; $i++) {
            $output = '- '.$output;
        }

        return $output;
    }

    public function possibleParents()
    {
        $family=[];
        if (!$this->owner->isNewRecord) {
            $family[] = $this->owner->id;
            $children = $this->owner->children()->select('id')->all();
            foreach ($children as $child) {
                $family[] =  $child->id ;
            }
        }
        return $this->owner->find()
            ->andWhere(['not in', 'id', $family])
            ->all();
    }

    public function getParent()
    {
        if ($this->owner->isNewRecord || $this->owner->isRoot()) {
            return null;
        }
        if (!isset($this->parent)) {
            $this->parent = $this->owner->parents(1)->one();
        }
        return $this->parent;
    }

    public function getParentId()
    {
        if (!isset($this->parentId)) {
            $this->parentId = (bool) $this->getParent() ? $this->getParent()->id : 0;
        }
        return $this->parentId;
    }

    public function setParentId($id)
    {
        $this->parentId = $id;
    }

    public function getFamilyTreeTitle()
    {
        if ($this->isRoot()) {
            return $this->owner->title;
        }

        $title = '';
        foreach ($this->parents()->all() as $parent) {
            $title .= $parent->title . ' -> ';
        }

        return $title . $this->owner->title;
    }
}
