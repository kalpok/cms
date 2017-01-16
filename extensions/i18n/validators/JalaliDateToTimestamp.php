<?php
namespace extensions\i18n\validators;

use Yii;
use yii\validators\Validator;
use extensions\i18n\date\DateTime;
use yii\base\InvalidParamException;

class JalaliDateToTimestamp extends Validator
{
    public $format = "Y/m/d|";
    public $hourAttr;
    public $minuteAttr;
    public $secondAttr;

    protected $dateTime;

    private $hour = 10, $minute = 0, $second = 0;

    public function __construct(DateTime $dateTime, $config = [])
    {
        $this->dateTime = $dateTime;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $format = $this->dateTime->date($this->format);
            $this->message = "تاریخ باید در فرمت '{$format}' باشد";
        }
    }

    public function validateAttribute($model, $attribute)
    {
        if ($this->dateTime->validate($model->$attribute, $this->format)) {
            $stamp = $this->dateTime->strtotime($model->$attribute, $this->format);
            $this->setHourMinuteSecond($model);
            $model->$attribute =
                $stamp + ($this->hour * 3600) + ($this->minute * 60) + $this->second;
        } else {
            $this->addError($model, $attribute, $this->message);
        }
    }

    public function setHourMinuteSecond($model)
    {
        $hourAttr = $this->hourAttr;
        if (isset($hourAttr, $model->$hourAttr)) {
            $this->hour = $model->$hourAttr;
        }
        $minuteAttr = $this->minuteAttr;
        if (isset($minuteAttr, $model->$minuteAttr)) {
            $this->minute = $model->$minuteAttr;
        }
        $secondAttr = $this->secondAttr;
        if (isset($secondAttr, $model->$secondAttr)) {
            $this->second = $model->$secondAttr;
        }
    }
}
