<?php
namespace modules\setting\components;

use Yii;
use modules\setting\models\Setting as SettingModel;

class Settings
{
    private $items;

    public function get($key)
    {
        if (!isset($this->items))
            $this->initializeItems();
        return isset($this->items[$key]) ? $this->items[$key]->value : null;
    }

    public function set($key, $value)
    {
        Yii::$app->db
            ->createCommand()
            ->update(
                'setting',
                ['value' => $value],
                '`key`=:key',
                [':key' => $key]
            )->execute();
    }

    private function initializeItems()
    {
        $this->items = SettingModel::find()->indexBy('key')->all();
    }
}
