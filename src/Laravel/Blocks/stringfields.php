<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class stringfields
{
    public static function makeString($blockname, $fieldname){
        $template = '<input type="text" data-field-type="%type%" data-field-name="%name%" data-block="%block%" class="input block_field" value="%value%" placeholder="Строка">';

        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%value%'
        );

        $replace  = array(
            $fieldname,
            'string',
            $blockname,
            "{{\$".$blockname."->".$fieldname."_field}}"
        );
        $string = str_replace($replaced,$replace, $template);

        return $string.PHP_EOL;
    }


    public static function makeGroupString($blockname, $groupname, $fieldname){

        $template = '<input type="text" data-field-type="%type%" data-field-name="%name%" data-block="%block%" data-group="%group%" class="input group_field" value="%value%" data-item-id="%id%" placeholder="Строка">';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace  = array(
            $fieldname,
            'string',
            $blockname,
            $groupname,
            "{{\$".'item_'.$groupname."->".$fieldname."_field}}",
            "{{\$".'item_'.$groupname."->id_field}}");

        $string = str_replace($replaced,$replace, $template);
        return $string.PHP_EOL;
    }
}