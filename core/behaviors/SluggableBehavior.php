<?php
namespace core\behaviors;

use Yii;
use core\helpers\Inflector;

class SluggableBehavior extends \yii\behaviors\SluggableBehavior
{
    private $language;

    protected function generateSlug($slugParts)
    {
        $this->setLanguage();
        if ($this->language != 'fa')
            return parent::generateSlug($slugParts);
        return Inflector::persianSlug(implode('-', $slugParts));
    }

    private function setLanguage()
    {
        if ($this->owner->language) {
            $this->language = $this->owner->language;
        }else{
            $this->language = \Yii::$app->language;
        }
    }
}
