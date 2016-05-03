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
        $template = '<label><input type="checkbox" data-field-type="%type%" data-field-name="%name%" data-block="%block%" class="input block_field" value="%value%">%name%</label>';
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
        $template = '<label><input type="checkbox" data-field-type="%type%" data-field-name="%name%" data-block="%block%" data-group="%group%" data-item-id="%id%" class="input group_field" value="%value%">%name%</label>';
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