<?php
namespace core\grid;

use yii\grid\DataColumn;
use yii\base\InvalidConfigException;

class ThumbnailColumn extends DataColumn
{
    public $group;
    public $label = '';
    public $preset = 'gridview-thumb';

    public function init()
    {
        if (!isset($this->group)) {
            throw new InvalidConfigException('$group propery of ThumbnailColumn must be set.');
        }
        $this->format = 'image';
        $this->filter = false;
        $this->value = function ($data) {
            $thumb = $data->getFile($this->group);
            return (null == $thumb) ?: $thumb->getUrl($this->preset);
        };
    }
}
