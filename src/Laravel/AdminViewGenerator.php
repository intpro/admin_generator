<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 21.08.2015
 * Time: 15:42
 */

namespace App;

use Illuminate\Foundation\AliasLoader;

class AdminViewGenerator {
    /*

    */

    public function AdminGenerate()
    {
        $path = public_path();
        $landings = config('qstorage');

      //  $adm_file = fopen($path.'/../resources/views/back/layout.blade.php','w+');

        foreach($landings as $blockname => $blockstruct){
                $this->makeBlock($blockname,$blockstruct);
        }
      //  fclose($adm_file);
        return 'OK';
    }

    public function  makeBlock($blockname, $blockstruct){

        $path = public_path();
        $block_file = fopen($path.'/../resources/views/back/blocks/'.$blockname.'.blade.php','w+');
        fwrite($block_file,'@extends(\'back.layout\')');
        fwrite($block_file,"\r\n");
        fwrite($block_file,'@section(\'content\')');
        fwrite($block_file,"\r\n");

        foreach($blockstruct as $fields => $field){
            if ($fields === 'title'){
                fwrite($block_file, config('Templates')['block_wrap']);
                fwrite($block_file, 'Заголовок'.$this->makeTitle($blockname,$fields));
                fwrite($block_file,"\r\n");
                fwrite($block_file,'</label>');
                fwrite($block_file,"\r\n");
                fwrite($block_file,'</div>');

            }else if ($fields === 'stringfields'){

                foreach($field as $item){
                    fwrite($block_file, config('Templates')['block_wrap']);
                    fwrite($block_file, $this->makeString($blockname, $item));
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</label>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</div>');
                }

            }else if ($fields === 'textfields'){

                foreach($field as $item){
                    fwrite($block_file, config('Templates')['block_wrap']);
                    fwrite($block_file, $this->makeText($blockname, $item));
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</label>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</div>');
                }

            }else if ($fields === 'images'){

                foreach($field as $item){
                    fwrite($block_file, config('Templates')['block_wrap']);
                    fwrite($block_file, $this->makeImage($blockname, $item));
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</label>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</div>');
                }


            }else if ($fields === 'numbs'){

                foreach($field as $item){
                    fwrite($block_file, config('Templates')['block_wrap']);
                    fwrite($block_file, $this->makeNumb($blockname, $item));
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</label>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</div>');
                }

            }else if ($fields === 'bools'){

                foreach($field as $item){
                    fwrite($block_file, config('Templates')['block_wrap']);
                    fwrite($block_file, $this->makeBool($blockname, $item));
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</label>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</div>');
                }

            }else if ($fields === 'groups'){

                $struct = $this->getInvertGroupsStruct($field);
                foreach($struct as $group_name => $item ){
                    if ($group_name === 'services'){
                    }
                    fwrite($block_file,'<ul class="group_block group_container" data-block="'.$blockname.'" data-group="'.$group_name.'" data-owner-id="">');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'@foreach('."\$".$blockname.'->'.$group_name.'_group  as '."\$".'item_'.$group_name.')');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'    @include(\'back.blocks.groupitems.'.$blockname.'.'.$group_name.'   \')');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'@endforeach');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,"</ul>");
                    fwrite($block_file,"\r\n");

                    fwrite($block_file,'  <button class="any_create" data-block="'.$blockname.'" data-group="'.$group_name.'"  data-descr="Эл. первой группы" data-owner-id="0">');
                    fwrite($block_file,"\r\n");

                    fwrite($block_file,'    <span>Добавить элемент первой группы</span>');
                    fwrite($block_file,"\r\n");
                    fwrite($block_file,'</button>');

                    fwrite($block_file,"\r\n");
                    $this->makeGroup($blockname,$group_name, $item);
                    fwrite($block_file,"\r\n");
                }

            }
        }
        fwrite($block_file, '<div class="block buttons">');
        fwrite($block_file, $this->makeSaveBtn($blockname));
        fwrite($block_file,"\r\n");
        fwrite($block_file,'</label>');
        fwrite($block_file,"\r\n");
        fwrite($block_file,'</div>');


        fwrite($block_file,"\r\n");
        fwrite($block_file,'@endsection');
        fwrite($block_file,"\r\n");
        fclose($block_file);


}


    public function  makeGroup($blockname,$groupname, $groupstruct){

        $path = public_path();
        if (!file_exists($path.'/../resources/views/back/blocks/groupitems/'.$blockname)){
            mkdir($path.'/../resources/views/back/blocks/groupitems/'.$blockname, 0777,true);
        }

        $group_file = fopen($path.'/../resources/views/back/blocks/groupitems/'.$blockname.'/'.$groupname.'.blade.php','w+');
        fwrite($group_file,'<li class="group_item" data-item-id="{{'."\$".'item_'.$groupname.'->id_field}}">');
        foreach($groupstruct as $fields => $field){


            if ($fields === 'title'){

            }else if ($fields === 'stringfields'){

                foreach($field as $item){

                    fwrite($group_file, $this->makeGroupString($blockname,$groupname, $item));
                    fwrite($group_file,"\r\n");
                }

            }else if ($fields === 'textfields'){

                foreach($field as $item){

                    fwrite($group_file, $this->makeGroupText($blockname,$groupname, $item));
                    fwrite($group_file,"\r\n");
                }

            }else if ($fields === 'images'){

                foreach($field as $item){

                    fwrite($group_file, $this->makeGroupImage($blockname,$groupname, $item));
                    fwrite($group_file,"\r\n");
                }


            }else if ($fields === 'numbs'){

                foreach($field as $item){

                    fwrite($group_file, $this->makeGroupNumb($blockname,$groupname, $item));
                    fwrite($group_file,"\r\n");
                }

            }else if ($fields === 'bools'){

                foreach($field as $item){

                    fwrite($group_file, $this->makeGroupBool($blockname,$groupname, $item));
                    fwrite($group_file,"\r\n");
                }

            }else if ($fields === 'owner'){

            }
        }
        fwrite($group_file,'<div class="buttons_block">');
        fwrite($group_file,"\r\n");
        fwrite($group_file,'<button type="button" class="any_save" data-block="'.$blockname.'" data-group="'.$groupname.'" data-entity="groupitem" data-item-id="{{'."\$".'item_'.$groupname.'->id_field}}" data-descr="Эл. первой группы"> Сохранить</button>');
        fwrite($group_file,"\r\n");
        fwrite($group_file,'<button type="button" class="any_delete" data-block="'.$blockname.'" data-group="'.$groupname.'" data-entity="groupitem" data-item-id="{{'."\$".'item_'.$groupname.'->id_field}}" data-descr="Эл. первой группы"> Удалить</button>');
        fwrite($group_file,"\r\n");
        fwrite($group_file,"</div>");
        fwrite($group_file,"\r\n");
        fwrite($group_file,"</li>");
        fclose($group_file);
    }
    protected  function makeTitle($blockname,$fieldname){

    }
    protected function makeString($blockname, $fieldname){
        $template = config('Templates')['stringfield'];
        $replaced = array('%name%','%type%','%block%','%value%');
        $replace  = array($fieldname, 'string', $blockname, "{{\$".$blockname."->".$fieldname."_field}}");
        $string = str_replace($replaced,$replace, $template);
        return $string;
    }
    protected function makeText($blockname, $fieldname){
        $template = config('Templates')['textfield'];
        $replaced = array('%name%','%type%','%block%','%value%');
        $replace  = array($fieldname, 'text', $blockname, "{{\$".$blockname."->".$fieldname."_field}}");
        $text = str_replace($replaced,$replace, $template);
        return $text;
    }
    protected function makeImage($blockname, $fieldname){

        $template = config('Templates')['image'];
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%preview%',
            '%primary%',
            '%secondary%',
            '%icon%',
            '%alt%');
        $replace  = array(
            $fieldname,
            'image',
            $blockname,
            "{{\$".$blockname."->".$fieldname."_image->preview_link}}",
            "{{\$".$blockname."->".$fieldname."_image->primary_link}}",
            "{{\$".$blockname."->".$fieldname."_image->secondary_link}}",
            "{{\$".$blockname."->".$fieldname."_image->icon_link}}",
            "{{\$".$blockname."->".$fieldname."_image->alt}}",
            "{{\$".$blockname."->".$fieldname."_image->id}}");
        $image = str_replace($replaced,$replace, $template);

        return $image;

    }
    protected function makeNumb($blockname, $fieldname){
        $template = config('Templates')['numb'];
        $replaced = array('%name%','%type%','%block%','%value%');
        $replace  = array($fieldname, 'numb', $blockname, "{{\$".$blockname."->".$fieldname."_field}}");
        $numb = str_replace($replaced,$replace, $template);
        return $numb;
    }
    protected function makeBool($blockname, $fieldname){
        $template = config('Templates')['bool'];
        $replaced = array('%name%','%type%','%block%','%value%');
        $replace  = array($fieldname, 'bool', $blockname, "{{\$".$blockname."->".$fieldname."_field}}");
        $numb = str_replace($replaced,$replace, $template);
        return $numb;
    }
    protected function makeSaveBtn($blockname){
        $template = config('Templates')['save_block'];
        $replaced = array('%block%');
        $replace  = array($blockname);
        $button = str_replace($replaced,$replace, $template);
        return $button;
    }





    protected function makeGroupString($blockname,$groupname, $fieldname){
        $template = config('Templates')['group_stringfield'];
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
            "{{\$".'item_'.$blockname."->".$fieldname."_field}}",
            "{{\$".'item_'.$blockname."->id_field}}");

        $string = str_replace($replaced,$replace, $template);
        return $string;
    }
    protected function makeGroupText($blockname,$groupname, $fieldname){
        $template = config('Templates')['group_textfield'];
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace  = array(
            $fieldname,
            'text',
            $blockname,
            $groupname,
            "{{\$".'item_'.$blockname."->".$fieldname."_field}}",
            "{{\$".'item_'.$blockname."->id_field}}");
        $text = str_replace($replaced,$replace, $template);
        return $text;
    }
    protected function makeGroupBool($blockname,$groupname, $fieldname){
        $template = config('Templates')['group_bool'];
        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%value%',
            '%id%');
        $replace  = array(
            $fieldname,
            'bool',
            $blockname,
            $groupname,
            "{{\$".'item_'.$blockname."->".$fieldname."_field}}",
            "{{\$".'item_'.$blockname."->id_field}}");
        $numb = str_replace($replaced,$replace, $template);
        return $numb;
    }
    protected function getInvertGroupsStruct($group_config) //getGroupsStruct
    {

        $groups_conf = $group_config;
        $groupstruct_invert = [];

        foreach ($groups_conf as $groupname => $_conf)
        {
            if(!array_key_exists($groupname, $groupstruct_invert))
            {
                $groupstruct_invert[$groupname] = $_conf;
            }

            if(array_key_exists('owner', $_conf))
            {
                if(!array_key_exists($_conf['owner'], $groupstruct_invert))
                {
                    $groupstruct_invert[$_conf['owner']] = [];
                }

                $groupstruct_invert[$_conf['owner']][] = $groupname;
            }
        }

        return $groupstruct_invert;
    }
}