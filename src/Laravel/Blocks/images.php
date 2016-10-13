<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 20:10
 */

namespace Interpro\AdminGenerator\Laravel\blocks;


class images
{
    public static function makeImage($blockname, $fieldname)
    {
        $template = '<div class="image-load">
                <div class="drag-n-drop">
                    <div class="drag"><input type="text" value="Отпустите клавишу мыши, чтобы загрузить файл"></div>
                    <div class="img-hide-block">
                <input type="hidden" class="prefix" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%prefix%">
                <input type="hidden" class="original_link" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%original%">
                <input type="hidden" class="preview_link" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%preview%">
                <input type="hidden" class="primary_link" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%primary%">
                <input type="hidden" class="secondary_link" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%secondary%">
                <input type="hidden" class="icon_link" data-field-name="%name%" data-field-type="%type%" data-block="%block%" value="%icon%">
            </div>

                    <div class="preview-block">
                        <label class="file-input">
                            <img src="/images/%preview%" class="preview" data-field-name="%name%" data-block="%block%">
                            <input type="file" accept="image/*" class="input_file block_field"  data-entity="block" data-field-name="%name%" data-field-type="%type%" data-block="%block%">
                        </label>
                    </div>

                    <div class="action-block">
                        <label class="alt-title">Альтернативный текст (если изображение не удалось загрузить)</label>
                        <input type="text" placeholder="alt текст" class="alt-text input-field" value="%alt%" data-field-name="%name%" data-block="%block%">
                    </div>
                </div>
            </div>';

        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%prefix%',
            '%original%',
            '%preview%',
            '%primary%',
            '%secondary%',
            '%icon%',
            '%alt%');
        $replace = array(
            $fieldname,
            'image',
            $blockname,
            "{{\$" . $blockname . "->" . $fieldname . "_image->prefix}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->original_link}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->preview_link}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->primary_link}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->secondary_link}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->icon_link}}",
            "{{\$" . $blockname . "->" . $fieldname . "_image->alt}}");
        $image = str_replace($replaced, $replace, $template);

        return $image . PHP_EOL;

    }


    public static function makeGroupImage($blockname, $groupname, $fieldname)
    {

        $template = '<div class="image-load">
                <div class="drag-n-drop">
                    <div class="drag"><input type="text" value="Отпустите клавишу мыши, чтобы загрузить файл"></div>
                    <div class="img-hide-block">
                <input type="hidden" class="prefix" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%prefix%">
                <input type="hidden" class="original_link" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%original%">
                <input type="hidden" class="preview_link" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%preview%">
                <input type="hidden" class="primary_link" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%primary%">
                <input type="hidden" class="secondary_link" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%secondary%">
                <input type="hidden" class="icon_link" data-field-name="%name%" data-group="%group%" data-field-type="%type%" data-item-id="%id%" data-block="%block%" value="%icon%">
            </div>
            <div class="preview-block">
            <label class="file-input">
                <img src="/images/%preview%" class="preview" data-field-name="%name%" data-block="%block%"  data-group="%group%" data-item-id="%id%">
<input type="file" accept="image/*" class="input_file group_field" data-field-name="%name%" data-field-type="%type%" data-block="%block%" data-group="%group%" data-item-id="%id%" data-entity="groupitem">                </label>
            </div>

                    <div class="preview-block">
                        <label class="file-input">
                            <img src="/images/%preview%" class="preview" data-field-name="%name%" data-block="%block%">
                            <input type="file" accept="image/*" class="input_file group_field" data-field-name="%name%" data-field-type="%type%" data-block="%block%" data-group="%group%" data-item-id="%id%" data-entity="groupitem">
                        </label>
                    </div>

                    <div class="action-block">
                        <label class="alt-title">Альтернативный текст (если изображение не удалось загрузить)</label>
                        <input type="text" placeholder="alt текст" class="alt-text" value="%alt%" data-item-id="%id%" data-field-name="%name%" data-block="%block%">
                    </div>
                </div>
            </div>';

        $replaced = array(
            '%name%',
            '%type%',
            '%block%',
            '%group%',
            '%prefix%',
            '%original%',
            '%preview%',
            '%primary%',
            '%secondary%',
            '%icon%',
            '%alt%',
            '%id%');
        $replace = array(
            $fieldname,
            'image',
            $blockname,
            $groupname,
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->prefix}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->original_link}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->preview_link}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->primary_link}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->secondary_link}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->icon_link}}",
            "{{\$" . 'item_' . $groupname . "->" . $fieldname . "_image->alt}}",
            "{{\$" . 'item_' . $groupname . "->" . "id_field}}",);

        $image = str_replace($replaced, $replace, $template);

        return $image . PHP_EOL;

    }

}