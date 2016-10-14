<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 04.03.2016
 * Time: 12:33
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class wrap
{
    public static function blockWrap($class = '')
    {
        return '<div class="block ' . $class . '">' . PHP_EOL;
    }

    public static function otherWrap($class = '')
    {
        return '<div class="' . $class . '">' . PHP_EOL;
    }

    public static function endBlockWrap()
    {
        return '</div>' . PHP_EOL;
    }

    public static function fieldWrap($class = '')
    {
        return '<div class="field-wrap ' . $class . '">' . PHP_EOL;
    }


    public static function blockLabel()
    {
        return '<label class="field-title"> Заголовок </label>' . PHP_EOL;
    }

    public static function otherLabel($class = '')
    {
        return '<label class="' . $class . '">' . PHP_EOL;
    }

    public static function makeGroupContainer($blockname, $groupname, $owner = false)
    {
        $template = '<ul class="group-block group_container" data-block="%block%" data-group="%group%" data-owner-id="%id%">';
        if ($owner) {
            $id = '{{$item_' . $groupname . '->id_field}}';
        } else {
            $id = 0;
        }
        $replaced = array(
            '%block%',
            '%group%',
            '%id%'
        );
        $replace = array(
            $blockname,
            $groupname,
            $id
        );
        $saveblock = str_replace($replaced, $replace, $template);
        return $saveblock . PHP_EOL;

    }

    public static function makeEndGroupContainer()
    {
        return '</ul>' . PHP_EOL;
    }

    public static function makePageContainer($blockname, $groupname, $owner = false)
    {
        $template = '<ul class="group-block group_container" data-block="%block%" data-group="%group%" data-owner-id="%id%">';
        if ($owner) {
            $id = '{{$item_' . $groupname . '->id_field}}';
        } else {
            $id = 0;
        }
        $replaced = array(
            '%block%',
            '%group%',
            '%id%'
        );
        $replace = array(
            $blockname,
            $groupname,
            $id
        );
        $saveblock = str_replace($replaced, $replace, $template);
        return $saveblock . PHP_EOL;

    }

    public static function makeEndPageContainer()
    {
        return '</ul>' . PHP_EOL;
    }


    public static function anyCreate($blockname, $groupname, $owner_id = '', $owner = false)
    {
        $template = '  <button class="any_create button blue" data-block="%block%" data-group="%group%"  data-descr="Эл. первой группы" data-owner-id="%id%">Добавить элемент</button>';
        if ($owner) {
            $id = '{{$item_' . $owner_id . '->id_field}}';
        } else {
            $id = 0;
        }
        $replaced = array(
            '%block%',
            '%group%',
            '%id%'
        );
        $replace = array(
            $blockname,
            $groupname,
            $id
        );
        $create = str_replace($replaced, $replace, $template);
        return $create . PHP_EOL;
    }


    public static function saveBlock($blockname)
    {
        $template = '<button class="btn btn-primary pull-right any_save" data-block="%block%" data-entity="block" data-descr="">
    <span class="save_button">Сохранить</span>
</button>';
        $replaced = array(
            '%block%'
        );
        $replace = array(
            $blockname
        );
        $saveblock = str_replace($replaced, $replace, $template);
        return $saveblock . PHP_EOL;

    }


    public static function saveGroup($blockname, $groupname)
    {
        $template = '<button type="button" class="any_save" data-block="%block%" data-group="%group%" data-entity="groupitem" data-item-id="%id%" data-descr="Эл. первой группы"> Сохранить</button>';
        $replaced = array(
            '%block%',
            '%group%',
            '%id%'
        );
        $replace = array(
            $blockname,
            $groupname,
            "{{\$item_" . $groupname . "->id_field}}"
        );
        $groupsave = str_replace($replaced, $replace, $template);
        return $groupsave . PHP_EOL;
    }


    public static function deleteGroup($blockname, $groupname)
    {
        $template = '<button type="button" class="any_delete button dark" data-block="%block%" data-group="%group%" data-entity="groupitem" data-item-id="%id%" data-descr="Эл. первой группы">Удалить</button>';
        $replaced = array(
            '%block%',
            '%group%',
            '%id%'
        );
        $replace = array(
            $blockname,
            $groupname,
            "{{\$item_" . $groupname . "->id_field}}"
        );
        $delete = str_replace($replaced, $replace, $template);
        return $delete . PHP_EOL;
    }
}