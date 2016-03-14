<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 17:24
 */

namespace Interpro\AdminGenerator\Laravel;

use Illuminate\Config;
use Interpro\AdminGenerator\Concept\AdminGenerator as AdminGeneratorInterface;
use Interpro\AdminGenerator\Laravel\Blocks\title;
use Interpro\AdminGenerator\Laravel\Blocks\stringfields;
use Interpro\AdminGenerator\Laravel\Blocks\textfields;
use Interpro\AdminGenerator\Laravel\Blocks\images;
use Interpro\AdminGenerator\Laravel\Blocks\bools;
use Interpro\AdminGenerator\Laravel\Blocks\numbs;
use Interpro\AdminGenerator\Laravel\Blocks\wrap;


class AdminGenerator implements AdminGeneratorInterface{

    public function makeAll(){

    }
    public function makeBlock($blockname){
        $config = config('qstorage');
        $block_file = fopen(public_path().'/../resources/views/back/blocks/'.$blockname.'.blade.php','w+');

        fwrite($block_file,'@extends(\'back.layout\')');
        fwrite($block_file,PHP_EOL);
        fwrite($block_file,'@section(\'content\')');
        fwrite($block_file,PHP_EOL);

        foreach($config[$blockname] as $fields => $field){

            if ( array_key_exists('title',$config[$blockname]) ){
                if($fields === 'title'){
                    fwrite($block_file, wrap::blockWrap());
                    fwrite($block_file, wrap::blockLabel());
                    fwrite($block_file, title::makeTitle($blockname));
                    fwrite($block_file, wrap::endBlockLabel());
                    fwrite($block_file, wrap::endBlockWrap());
                }
            }

            if (array_key_exists('stringfields',$config[$blockname])){
                if ($fields === 'stringfields'){
                    foreach($field as $item){
                        fwrite($block_file, wrap::blockWrap());
                        fwrite($block_file, wrap::blockLabel());
                        fwrite($block_file, stringfields::makeString($blockname,$item));
                        fwrite($block_file, wrap::endBlockLabel());
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('textfields',$config[$blockname])){
                if ($fields === 'textfields'){
                    foreach($field as $item){
                        fwrite($block_file, wrap::blockWrap());
                        fwrite($block_file, wrap::blockLabel());
                        fwrite($block_file, textfields::makeText($blockname,$item));
                        fwrite($block_file, wrap::endBlockLabel());
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('images',$config[$blockname])){
                if ($fields === 'images'){
                    foreach($field as $item){
                        fwrite($block_file, wrap::blockWrap());
                        fwrite($block_file, wrap::blockLabel());
                        fwrite($block_file, images::makeImage($blockname,$item));
                        fwrite($block_file, wrap::endBlockLabel());
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('numbs',$config[$blockname])){
                if ($fields === 'numbs'){
                    foreach($field as $item){
                        fwrite($block_file, wrap::blockWrap());
                        fwrite($block_file, wrap::blockLabel());
                        fwrite($block_file, numbs::makeNumb($blockname,$item));
                        fwrite($block_file, wrap::endBlockLabel());
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }

            if (array_key_exists('bools',$config[$blockname])){
                if ($fields === 'bools'){
                    foreach($field as $item){
                        fwrite($block_file, wrap::blockWrap());
                        fwrite($block_file, wrap::blockLabel());
                        fwrite($block_file, bools::makeBool($blockname,$item));
                        fwrite($block_file, wrap::endBlockLabel());
                        fwrite($block_file, wrap::endBlockWrap());
                    }
                }
            }
            if (array_key_exists('groups',$config[$blockname])){
                if($fields === 'groups'){

                    foreach($field as $item => $item_name){
//dd($item);
                        if(!array_key_exists('owner',$item_name)){
                            $page_config = config('page');
                            if (array_key_exists($item,$page_config)){
                                fwrite($block_file, wrap::blockWrap());
                                fwrite($block_file,'<table>'.PHP_EOL);
                                fwrite($block_file,'<thead>'.PHP_EOL);
                                fwrite($block_file,'<tr>'.PHP_EOL);
                                fwrite($block_file,'<td>Название</td>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td>Публикации</td>'.PHP_EOL);
                                fwrite($block_file,'<td>Сортировка</td>'.PHP_EOL);
                                fwrite($block_file,'<td>Редактировать</td>'.PHP_EOL);
                                fwrite($block_file,'<td>Удалить</td>'.PHP_EOL);
                                fwrite($block_file,'</tr>'.PHP_EOL);
                                fwrite($block_file,'</thead>'.PHP_EOL);
                                fwrite($block_file,wrap::makePageContainer($blockname,$item));
                                fwrite($block_file,'@foreach($'.$blockname.'->'.$item.'_group as $item_'.$item.' )'.PHP_EOL);
                                $this->makeGroup($blockname,$item);
                                fwrite($block_file,'@include('."'".'back.blocks.groupitems.'.$blockname.'.'.$item."'".')'.PHP_EOL);
                                fwrite($block_file,'@endforeach'.PHP_EOL);
                                fwrite($block_file,wrap::makeEndPageContainer());
                                fwrite($block_file,'<tfoot>'.PHP_EOL);
                                fwrite($block_file,'<tr>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td></td>'.PHP_EOL);
                                fwrite($block_file,'<td>'.PHP_EOL);
                                fwrite($block_file,wrap::anyCreate($blockname,$item));
                                fwrite($block_file,'</td>'.PHP_EOL);
                                fwrite($block_file,'</tr>'.PHP_EOL);

                                fwrite($block_file,'</tfoot>'.PHP_EOL);
                                fwrite($block_file,'</table>'.PHP_EOL);
                                fwrite($block_file, wrap::endBlockWrap());
                            }else{
                                fwrite($block_file, wrap::blockWrap());
                                fwrite($block_file, wrap::blockLabel());
                                fwrite($block_file,wrap::makeGroupContainer($blockname,$item));
                                fwrite($block_file,'@foreach($'.$blockname.'->'.$item.'_group as $item_'.$item.' )'.PHP_EOL);
                                $this->makeGroup($blockname,$item);
                                fwrite($block_file,'@include('."'".'back.blocks.groupitems.'.$blockname.'.'.$item."'".')'.PHP_EOL);
                                fwrite($block_file,'@endforeach'.PHP_EOL);
                                fwrite($block_file,wrap::makeEndGroupContainer());
                                fwrite($block_file,wrap::anyCreate($blockname,$item));
                                fwrite($block_file, wrap::endBlockLabel());
                                fwrite($block_file, wrap::endBlockWrap());
                            }
                        }
                    }
                }
            }
        }
        fwrite($block_file, wrap::blockWrap('buttons'));
        fwrite($block_file, wrap::saveBlock($blockname));
        fwrite($block_file, wrap::endBlockWrap());
        fwrite($block_file,'@endsection');
        fclose($block_file);
    }


    public function makeGroup($blockname ,$groupname){
        $page_config = config('page');
        if (array_key_exists($groupname,$page_config)){

            groupGenerator::makePageGroup($blockname,$groupname);
            groupGenerator::makePageStatic($blockname,$groupname);

        }else{

            groupGenerator::makeStaticGroup($blockname,$groupname);

        }

    }

    public function MakeDirectory(){
        if (!file_exists(public_path().'/../resources/views/back/blocks/groupitems')){
            mkdir(public_path().'/../resources/views/back/blocks/groupitems/', 0777,true);
        }
    }

    public function getInvertGroupsStruct($group_config) //getGroupsStruct
    {

        $groups_conf = $group_config;
        $groupstruct_invert = [];

        foreach ($groups_conf as $groupname => $_conf)
        {
            if(!array_key_exists($groupname, $groupstruct_invert))
            {
                $groupstruct_invert[$groupname] = [];
            }

            if(array_key_exists('owner', $_conf))
            {
                if(!array_key_exists($_conf['owner'], $groupstruct_invert))
                {
                    $groupstruct_invert[$_conf['owner']] = [];
                }

                $groupstruct_invert[$_conf['owner']][] =$groupname;
            }
        }

        return $groupstruct_invert;
    }
}