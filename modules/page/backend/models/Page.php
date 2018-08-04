<?php
namespace modules\page\backend\models;

use yii\helpers\ArrayHelper;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Page extends \modules\page\common\models\Page
{
    private $parent;
    private $parentId;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
                'sluggable' => [
                    'class' => 'core\behaviors\SluggableBehavior',
                    'attribute' => 'title',
                ],
                [
                    'class' => FileBehavior::className(),
                    'groups' => [
                        'image' => [
                            'type' => FileBehavior::TYPE_IMAGE,
                            'rules' => [
                                'extensions' => ['png', 'jpg', 'jpeg'],
                                'maxSize' => 1024*1024,
                            ]
                        ],
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'content', 'parentId'], 'required'],
            ['title', 'trim'],
            [['content', 'summary'], 'string'],
            ['isActive', 'integer'],
            ['language', 'default', 'value' => null],
            ['title', 'string', 'max' => 255],
            [['title', 'content'], FarsiCharactersValidator::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'summary' => 'خلاصه',
            'isActive' => 'نمایش در سایت',
            'language' => 'زبان',
            'content' => 'محتوای برگه',
            'parentId' => 'برگه پدر',
            'createdAt' => 'تاریخ ساخت برگه',
            'updatedAt' => 'آخرین بروزرسانی',
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    public function getPrefixedTitle()
    {
        $prefix = '';
        for ($i = 0; $i < $this->depth; $i++) {
            $prefix .= '- ';
        }

        return $prefix.' '.$this->title;
    }

    public function possibleParents()
    {
        $family=[];
        if (!$this->isNewRecord) {
            $family[] = $this->id;
            $children = $this->children()->all();
            foreach ($children as $child) {
                $family[] =  $child->id ;
            }
        }
        return static::find()
            ->andWhere(['not in', 'id', $family])
            ->orderBy(['root' => SORT_DESC,'lft' => SORT_ASC])
            ->all();
    }

    public function getParentsForSelect2()
    {
        return ['آیتم سطح نخست است'] +
            ArrayHelper::map($this->possibleParents(), 'id', 'prefixedTitle');
    }

    public function getParent()
    {
        if ($this->isNewRecord || $this->isRoot()) {
            return null;
        }
        if (!isset($this->parent)) {
            $this->parent = $this->parents(1)->one();
        }
        return $this->parent;
    }

    public function getParentId()
    {
        if (!isset($this->parentId)) {
            $this->parentId = ($this->getParent()) ? $this->getParent()->id : 0;
        }
        return $this->parentId;
    }

    public function setParentId($id)
    {
        $this->parentId = $id;
    }
}
