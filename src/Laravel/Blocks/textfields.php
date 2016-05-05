<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class textfields
{


    public static function makeText($blockname, $fieldname)
    {
        $template = '<textarea data-field-type="%type%" data-field-name="%name%" data-block="%block%" class="input block_field" placeholder="Текст">%value%</textarea>';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%value%'
        );
        $replace = array(
            $fieldname,
            'text',
            $blockname,
            "{{\$" . $blockname . "->" . $fieldname . "_field}}"
        );

        $text = str_replace($replaced, $replace, $template);
        return $text . PHP_EOL;
    }

    public static function makeGroupText($blockname, $groupname, $fieldname)
    {
        $template = '<textarea data-field-type="%type%" data-field-name="%name%" data-block="%block%" data-group="%group%" class="input group_field" data-item-id="%id%" placeholder="Текст">%value%</textarea>';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');

        $replace = array(
            $fieldname,
            'text',
            $blockname,
            $groupname,
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_field}}",
            "{{\$" . 'item_' . $groupname . "->id_field}}");

        $text = str_replace($replaced, $replace, $template);
        return $text . PHP_EOL;
    }
}