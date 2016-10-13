<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class numbs
{
    public static function makeNumb($blockname, $fieldname){
        $template = '<input type="number" data-field-type="%type%" data-field-name="%name%" data-block="%block%" class="input-field block_field" value="%value%" placeholder="Целое число">';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%value%'
        );
        $replace  = array(
            $fieldname,
            'numb',
            $blockname,
            "{{\$".$blockname."->".$fieldname."_field}}"
        );
        $numb = str_replace($replaced,$replace, $template);
        return $numb.PHP_EOL;
    }
    public static function makeGroupNumb($blockname, $groupname, $fieldname){
        $template = '<input type="number" data-field-type="%type%" data-field-name="%name%" data-block="%block%" data-group="%group%" data-item-id="%id%" class="input-field group_field" value="%value%" placeholder="Целое число">';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace  = array(
            $fieldname,
            'numb',
            $blockname,
            $groupname,
            "{{\$".'item_'.$groupname."->".$fieldname."_field}}",
            "{{\$".'item_'.$groupname."->id_field}}");
        $numb = str_replace($replaced,$replace, $template);
        return $numb.PHP_EOL;
    }
}