<?php
namespace modules\slider\widgets;

use extensions\i18n\language\Language;
use extensions\gallery\models\Gallery;

class HomeSlider extends \yii\base\Widget
{
    public $numberOfSlides;
    private $language;
    private $handle;

    function __construct(Language $lang, $config = []) {
        $this->language = $lang;
        $this->setHandle();
        parent::__construct($config);
    }

    private function setHandle()
    {
        $this->handle = 'home-' . $this->language->code;
    }

    public function run()
    {
        $gallery = Gallery::loadByHandle($this->handle);
        if ($gallery) {
            return $this->render('homeSlider', [
                'images' => $gallery->getImages()->all()
            ]);
        }
    }
}
