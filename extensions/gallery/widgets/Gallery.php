<?php
namespace extensions\gallery\widgets;

use yii\base\Widget;
use yii\helpers\Json;

class Gallery extends Widget
{
    public $view = 'simplegallery';
    public $images;
    public $id = '';
    public $clientOptions = [];

    public function init()
    {
        parent::init();
        $this->clientOptions = Json::encode($this->clientOptions);
    }

    public function run()
    {
        if (empty($this->images)) {
            return;
        }
        return $this->render(
            $this->view,
            [
                'images' => $this->images,
            ]
        );
    }
}
