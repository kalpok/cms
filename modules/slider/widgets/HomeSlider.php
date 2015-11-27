<?php
namespace modules\slider\widgets;

use kalpok\i18n\Language;
use kalpok\gallery\models\Gallery;

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
        switch ($this->language->code) {
            case 'fa':
                $this->handle = 'home-fa';
                break;
            case 'en':
                $this->handle = 'home-en';
                break;
            case 'ar':
                $this->handle = 'home-ar';
                break;
            default:
                $this->handle = 'home-fa';
                break;
        }
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
