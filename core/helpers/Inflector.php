<?php
namespace core\helpers;

class Inflector extends \yii\helpers\Inflector
{
    public static function slug($string, $replacement = '-', $lowercase = true)
    {
        $string = preg_replace('/[^a-zA-Z0-9.=\s—–-]+/u', ' ', $string);
        $string = preg_replace('/[=\s—–-]+/u', $replacement, $string);
        $string = trim($string, $replacement);
        return $lowercase ? strtolower($string) : $string;
    }

    public static function persianSlug($string, $replacement = '-', $lowercase = true)
    {
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-zآ-ی۰-۹0-9]/u", "{$replacement}", $string);
        $string = preg_replace("/[{$replacement}]+/u", "{$replacement}", $string);
        return $string;
    }
}
