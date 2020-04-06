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

    public function hasAnyTags($tagTitles)
    {
        if (!$tagTitles) {
            return $this->owner;
        }

        return $this->owner->andWhere([
            'in',
            'id',
            $this->getModelIdsHaveAnyTags($tagTitles)
        ]);
    }

    public function hasExactTags($tagTitles)
    {
        if (!$tagTitles) {
            return $this->owner;
        }

        return $this->owner->andWhere([
            'in',
            'id',
            $this->getModelIdsHaveExactTags($tagTitles)
        ]);
    }

    private function getModelIdsHaveAnyTags($tagTitles)
    {
        return (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('tag_module')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => $this->modelShortClassName
            ])
            ->andWhere(['in', 'tagId', $this->getTagIds($tagTitles)])
            ->column();
    }

    private function getModelIdsHaveExactTags($tagTitles)
    {
        return (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('tag_module')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => $this->modelShortClassName
            ])
            ->andWhere(['in', 'tagId', $this->getTagIds($tagTitles)])
            ->groupBy('modelId')
            ->having('COUNT(modelId) = ' . count($tagTitles))
            ->column();
    }

    private function getTagIds($tagTitles)
    {
        return (new \yii\db\Query())
            ->select('id')
            ->from('tag')
            ->andWhere(['in', 'title', $tagTitles])
            ->column();
    }
}
