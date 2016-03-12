<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;

class title
{
    public static function makeTitle($blockname){
        $template = '<input type="text" data-field-type="%type%" data-field-name="%name%" data-block="%block%" class="input block_pre_field" value="%value%" placeholder="Заголовок">';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%value%'
        );
        $replace  = array(
            'title',
            'string',
            $blockname,
            "{{\$".$blockname."->title_field}}"
        );
        $title = str_replace($replaced,$replace, $template);

        return $title.PHP_EOL;
    }
    public static function makeSlug($blockname,$groupname){

        $template = '<input type="text" data-field-type="%type%" data-field-name="%name%" data-block="%block%" data-group="%group%" class="input group_pre_field" value="%value%" data-item-id="%id%" placeholder="Строка">';
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace  = array(
            'slug',
            'string',
            $blockname,
            $groupname,
            "{{\$".'item_'.$groupname."->slug_field}}",
            "{{\$".'item_'.$groupname."->id_field}}");

        $string = str_replace($replaced,$replace, $template);
        return $string.PHP_EOL;
    }
    public static function makeShowBlock($blockname){

    }
    public static function makeShowGroup($blockname,$groupname){

    }
}