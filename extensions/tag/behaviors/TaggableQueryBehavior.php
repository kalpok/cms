<?php

namespace extensions\tag\behaviors;

use yii\db\Query;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

class TaggableQueryBehavior extends Behavior
{
    public $moduleId;
    public $modelShortClassName;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if (empty($this->modelShortClassName)) {
            throw new InvalidConfigException('modelShortClassName property must be set.');
        }
        parent::init();
    }

    public function anyTagTitles($tagTitles)
    {
        if (!$tagTitles) {
            return $this->owner;
        }
        
        $tagIds = [];
        foreach ($tagTitles as $tagTitle) {
            $tagIds[] = $this->getTagId($tagTitle);
        }
        $modelIds = (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('tag_module')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => $this->modelShortClassName
            ])
            ->andWhere(['in', 'tagId', $tagIds])
            ->column();
        $this->owner->andWhere(['in', 'id', $modelIds]);

        return $this->owner;
    }

    private function getTagId($tag)
    {
        return (new Query())
            ->select(['id'])
            ->from('tag')
            ->where(['title' => $tag])
            ->scalar();
    }
}
