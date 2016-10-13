<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class bools
{
    public static function makeBool($blockname, $fieldname)
    {
        $template = '<div class="checkbox"><label class="click-wrap"><input type="checkbox" class="checkbox-widget input block_field" data-field-type="%type%" data-field-name="%name%" data-block="%block%"  value="%value%"><label for="checkbox-widget" class="checkbox-label">Вкл</label></label></div>';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%value%');
        $replace = array(
            $fieldname,
            'bool',
            $blockname,
            "{{\$" . $blockname . "->" . $fieldname . "_field}}");
        $numb = str_replace($replaced, $replace, $template);
        return $numb . PHP_EOL;
    }

    public static function makeGroupBool($blockname, $groupname, $fieldname)
    {
        $template = '<div class="checkbox"><label class="click-wrap"><input type="checkbox" class="checkbox-widget input group_field" data-field-type="%type%" data-item-id="%id%" data-field-name="%name%" data-block="%block%"  value="%value%"><label for="checkbox-widget" class="checkbox-label">Вкл</label></label></div>';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace = array(
            $fieldname,
            'bool',
            $blockname,
            $groupname,
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_field}}",
            "{{\$" . 'item_' . $groupname . "->id_field}}");
        $numb = str_replace($replaced, $replace, $template);
        return $numb . PHP_EOL;
    }

}