<?php

namespace extensions\tag\behaviors;

use Yii;
use yii\db\Query;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class TaggableBehavior extends Behavior
{
    private $tags;

    public $moduleId;
    public $modelClassName;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'attachTags',
            ActiveRecord::EVENT_AFTER_UPDATE => 'attachTags',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteTags'
        ];
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function attachTags()
    {
        if (empty($this->tags)) {
            return;
        }

        if (!$this->owner->isNewRecord) {
            $this->deleteTags();
        }

        foreach ($this->tags as $tag) {
            if (!$this->isTagExist($tag)) {
                $this->insertTag($tag);
            }
            $tagId = $this->getTagId($tag);
            $rows[] = [
                $tagId,
                $this->moduleId,
                (new \ReflectionClass($this->owner))
                    ->getShortName(),
                $this->owner->getPrimaryKey()
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'tag_module',
                ['tagId', 'moduleId', 'modelClassName', 'modelId'],
                $rows
            )->execute();
        }
    }

    public function deleteTags()
    {
        Yii::$app->db->createCommand()->delete('tag_module', [
            'moduleId' => $this->moduleId,
            'modelClassName' => (new \ReflectionClass($this->owner))
                ->getShortName(),
            'modelId' => $this->owner->getPrimaryKey()
        ])->execute();
    }

    public function getTags()
    {
        return $this->getTagsAsArray();
    }

    public function getTagsAsString()
    {
        return $this->getTagsAsArray() == [] ? ''
            : implode(', ', $this->getTagsAsArray());
    }

    public function getTagsAsArray()
    {
        if (!$this->owner->isNewRecord && $this->tags === null) {
            $this->tags = (new Query())
                ->select(['title'])
                ->from('tag')
                ->innerJoin('tag_module', 'tag.id = tag_module.tagId')
                ->where([
                    'moduleId' => $this->moduleId,
                    'modelClassName' => (new \ReflectionClass($this->owner))
                        ->getShortName(),
                    'modelId' => $this->owner->getPrimaryKey()
                ])
                ->column();
        }

        return $this->tags == null ? [] : $this->tags;
    }

    private function isTagExist($tag)
    {
        return (new Query())
            ->from('tag')
            ->where(['title' => $tag])
            ->exists();
    }

    private function insertTag($tag)
    {
        Yii::$app->db->createCommand()->insert('tag', [
            'title' => $tag
        ])->execute();
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
