<?php
namespace core\helpers;

use Yii;

class Utility
{
    /**
     * mainly used in data input forms like when having priority field
     * @return array
     */
    public static function listNumbers($from, $to)
    {
        $list = [];
        $reverse = ($from > $to);
        if ($reverse) {
            for ($i = $from; $i >= $to; $i--) {
                $list[$i] = Yii::$app->i18n->translateNumber($i);
            }
        } else {
            for ($i = $from; $i <= $to; $i++) {
                $list[$i] = Yii::$app->i18n->translateNumber($i);
            }
        }
        return $list;
    }

    /**
     * makes data ready for Selectize widget
     * @param  array $models
     * @param  string $label field to be used as option labels in rendered field
     * @param  string $value field to be used as data sent to server when an option is selected
     * @return array
     */
    public static function makeReadyForSelectize($models, $label, $value)
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = [
                $label => $model->$label,
                $value => $model->$value
            ];
        }
        return $items;
    }

    public static function makeExcerpt($string, $length = 200, $endingChars = '...')
    {
        if (strlen($string) > $length) {
            $excerpt = substr($string, 0, $length - 3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= ' ' . $endingChars;
        } else {
            $excerpt = $string;
        }

        return $excerpt;
    }

    public static function makeStringShorten($string, $wordsNumber = 20)
    {
        $stringAsArray = explode(' ', $string);
        if (count($stringAsArray) > $wordsNumber) {
            return implode(
                ' ',
                array_splice($stringAsArray, 0, $wordsNumber)
            ) . ' ... ';
        }
        return $string;
    }
}
