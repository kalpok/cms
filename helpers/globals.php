<?php
use yii\helpers\VarDumper;

/*
 * dumps given value to firebug console
 */
function fb($what){
  echo Yii::trace(VarDumper::dumpAsString($what), 'vardump');
}

/**
 * Dump and die - Dump as many variables as you want. Infinite parameters.
*/
function dd() {
    $args = func_get_args();
    foreach($args as $k => $arg){
        echo '<fieldset class="debug">
        <legend>'.($k+1).'</legend>';
        VarDumper::dump($arg, 10, true);
        echo '</fieldset>';
    }
    die;
}
