<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 04.03.2016
 * Time: 15:49
 */

namespace Interpro\AdminGenerator\Laravel;

use Interpro\AdminGenerator\Laravel\Blocks\title;
use Interpro\AdminGenerator\Laravel\Blocks\stringfields;
use Interpro\AdminGenerator\Laravel\Blocks\textfields;
use Interpro\AdminGenerator\Laravel\Blocks\images;
use Interpro\AdminGenerator\Laravel\Blocks\bools;
use Interpro\AdminGenerator\Laravel\Blocks\numbs;
use Interpro\AdminGenerator\Laravel\Blocks\wrap;


class groupGenerator
{
    public static function makeStaticGroup($blockname, $groupname)
    {
        //  dd($groupname);
        $config = config('qstorage');
        $admin = new AdminGenerator();
        if (!file_exists(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname)) {
            mkdir(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname, 0777, true);
        }

        $block_file = fopen(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname . '/' . $groupname . '.blade.php', 'w+');

        fwrite($block_file, '<li class="group" data-group-id="{{$item_' . $groupname . '->id_field}}">');
        fwrite($block_file, wrap::otherWrap('title-block'));
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file, wrap::blockWrap());

        //dd($config[$blockname]['groups'][$groupname]);
        foreach ($config[$blockname]['groups'][$groupname] as $fields => $field) {

            if (array_key_exists('title', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'title') {
                    fwrite($block_file, wrap::fieldWrap());
                    fwrite($block_file, wrap::blockLabel());

                    fwrite($block_file, title::makeTitle($blockname));
                    fwrite($block_file, wrap::endBlockWrap());
                }
            }
            if (array_key_exists('stringfields', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'stringfields') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, stringfields::makeGroupString($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('textfields', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'textfields') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, textfields::makeGroupText($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('images', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'images') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, images::makeGroupImage($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('numbs', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'numbs') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, numbs::makeGroupNumb($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('bools', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'bools') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, bools::makeGroupBool($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            $struct = $admin->getInvertGroupsStruct($config[$blockname]['groups']);
            foreach ($struct[$groupname] as $item => $item_name) {
                fwrite($block_file, '@foreach($item_' . $groupname . '->' . $item_name . '_group as $item_' . $item_name . ' )' . PHP_EOL);
                $admin->makeGroup($blockname, $item_name);
                fwrite($block_file, '@endforeach' . PHP_EOL);
            }

        }
        fwrite($block_file, wrap::fieldWrap('buttons_block'));
        fwrite($block_file, '<div class="col-1-2">');
        fwrite($block_file, wrap::deleteGroup($blockname, $groupname));
        fwrite($block_file, '</div>');
        fwrite($block_file, '<div class="col-1-2 disabled">');
        fwrite($block_file, wrap::saveGroup($blockname, $groupname));
        fwrite($block_file, '</div>');
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file, '</li>');
        fclose($block_file);
    }

    public static function makePageGroup($blockname, $groupname)
    {

        $config = config('qstorage');
        $admin = new AdminGenerator();
        if (!file_exists(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname)) {
            mkdir(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname, 0777, true);
        }

        $block_file = fopen(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname . '/' . $groupname . '_edit.blade.php', 'w+');
        fwrite($block_file, '@extends(\'back.layout\')');
        fwrite($block_file, PHP_EOL);
        fwrite($block_file, '@section(\'content\')');
        fwrite($block_file, PHP_EOL);
        fwrite($block_file, '<li class="group" data-group-id="{{$item_' . $groupname . '->id_field}}">');

        fwrite($block_file, wrap::blockWrap());

        foreach ($config[$blockname]['groups'][$groupname] as $fields => $field) {


            if (array_key_exists('stringfields', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'stringfields') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, stringfields::makeGroupString($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                        if ($item === 'name') {
                            fwrite($block_file, wrap::fieldWrap());
                            fwrite($block_file, wrap::blockLabel());

                            fwrite($block_file, title::makeSlug($blockname, $groupname));
                            fwrite($block_file, wrap::endBlockWrap());
                        }
                    }
                }
            }
            if (array_key_exists('textfields', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'textfields') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, textfields::makeGroupText($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('images', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'images') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, images::makeGroupImage($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('numbs', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'numbs') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, numbs::makeGroupNumb($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('bools', $config[$blockname]['groups'][$groupname])) {
                if ($fields === 'bools') {
                    foreach ($field as $item) {
                        fwrite($block_file, wrap::fieldWrap());
                        fwrite($block_file, wrap::blockLabel());

                        fwrite($block_file, bools::makeGroupBool($blockname, $groupname, $item));
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            $struct = $admin->getInvertGroupsStruct($config[$blockname]['groups']);
            foreach ($struct[$groupname] as $item => $item_name) {

                $page_config = config('page');
                if (array_key_exists($item, $page_config)) {
                    fwrite($block_file, wrap::fieldWrap());
                    fwrite($block_file, wrap::fieldWrap());
                    fwrite($block_file, '<div class="row-title">');
                    fwrite($block_file, '<div class="col-1-5">Название</div>');
                    fwrite($block_file, '<div class="col-1-5">Дата изменения</div>');
                    fwrite($block_file, '<div class="col-1-5">Позиция</div>');
                    fwrite($block_file, '<div class="col-1-5"></div>');
                    fwrite($block_file, '<div class="col-1-5"></div>');
                    fwrite($block_file, '</div>');
                    fwrite($block_file, wrap::makePageContainer($blockname, $item_name, true));
                    fwrite($block_file, '@foreach($' . $blockname . '->' . $item_name . '_group as $item_' . $item_name . ' )' . PHP_EOL);
                    $admin->makeGroup($blockname, $item_name);
                    fwrite($block_file, '@include(' . "'" . 'back.blocks.groupitems.' . $blockname . '.' . $item_name . "'" . ')' . PHP_EOL);
                    fwrite($block_file, '@endforeach' . PHP_EOL);
                    fwrite($block_file, wrap::makeEndPageContainer());
                    fwrite($block_file, '<div class="col-1-2">');
                    fwrite($block_file, wrap::anyCreate($blockname,$item));
                    fwrite($block_file, '</div">');
                    fwrite($block_file, '<div class="col-1-2 disabled">');
                    fwrite($block_file, '</div>');
                    fwrite($block_file, wrap::endBlockWrap());
                } else {
                    fwrite($block_file, wrap::fieldWrap('group-wrap'));
                    fwrite($block_file, '<div class="group-title-row">');
                    fwrite($block_file, '<label class="group-title">'.$item.'</label>');
                    fwrite($block_file, wrap::anyCreate($blockname,$item));
                    fwrite($block_file, '</div>');
                    fwrite($block_file, wrap::makeGroupContainer($blockname, $groupname, true));
                    fwrite($block_file, '@foreach($item_' . $groupname . '->' . $item_name . '_group as $item_' . $item_name . ' )' . PHP_EOL);
                    $admin->makeGroup($blockname, $item_name);
                    fwrite($block_file, '@include(' . "'" . 'back.blocks.groupitems.' . $blockname . '.' . $item_name . "'" . ')' . PHP_EOL);
                    fwrite($block_file, '@endforeach' . PHP_EOL);
                    fwrite($block_file, wrap::makeEndGroupContainer());
                    fwrite($block_file, wrap::anyCreate($blockname, $item_name, $groupname, true));
                }
            }


        }
        fwrite($block_file, wrap::fieldWrap('buttons disabled'));
        fwrite($block_file, wrap::saveGroup($blockname, $groupname));
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file, '</li>');
        fwrite($block_file, '@endsection');
        fclose($block_file);
    }

    public static function makePageStatic($blockname, $groupname)
    {
        if (!file_exists(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname)) {
            mkdir(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname, 0777, true);
        }

        $block_file = fopen(public_path() . '/../resources/views/back/blocks/groupitems/' . $blockname . '/' . $groupname . '.blade.php', 'w+');
        fwrite($block_file, '<li class="row-item" data-sorter="{{$item_' . $groupname . '->sorter_field}}" data-id="{{$item_' . $groupname . '->id_field}}">' . PHP_EOL);
        fwrite($block_file, '<div class="column-item"><a href="/adm/edit/' . $groupname . '/{{$item_' . $groupname . '->id_field}}">{{$item_'.$groupname.'->title_field}}</a></div>' . PHP_EOL);
        fwrite($block_file, '<div class="column-item"></div>' . PHP_EOL);
        fwrite($block_file, '<div class="column-item"><p>{{$item_'.$groupname.'->sorter_field}}</p></div>' . PHP_EOL);
        fwrite($block_file, '<div class="column-item"></div>' . PHP_EOL);
        fwrite($block_file, '<div class="column-item">'.wrap::deleteGroup($blockname, $groupname).'</div>' . PHP_EOL);
        fwrite($block_file, '</li>' . PHP_EOL);
        fclose($block_file);
    }

}