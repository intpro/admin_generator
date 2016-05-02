<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 22.04.2016
 * Time: 12:24
 */

namespace Interpro\AdminGenerator\Laravel;

use Interpro\AdminGenerator\Concept\ResizeGenerator as ResizeGeneratorInterface;
use Interpro\AdminGenerator\Laravel\Blocks\resize_wrap;

class ResizeGenerator implements ResizeGeneratorInterface
{

    public function makeResize()
    {
        $config = config('qstorage');
        if (file_exists(public_path() . '/../config/resize.php')){
            rename(public_path() . '/../config/resize.php', public_path() . '/../config/resize_backup.php');
        }

        $resize_file = fopen(public_path() . '/../config/resize.php', 'w+');
        $msg = '';

        fwrite($resize_file, '<?php' . PHP_EOL);
        fwrite($resize_file, 'return [' . PHP_EOL);

        foreach ($config as $block_name => $block) {
            if ($block_name !== 'dom_all_images') {
                if ((array_key_exists('images', $block)) or (array_key_exists('groups', $block))) {
                    foreach ($block as $field_name => $field) {

                        if ($field_name === 'images') {
                            foreach ($field as $key => $value) {
                                fwrite($resize_file, resize_wrap::resizeWrap($block_name, $value));
                            }
                            $msg = $msg . 'Ресайз сгенерирован  ' . $block_name . '</br>';
                        }

                        if ($field_name === 'groups') {
                            foreach ($field as $group_name => $group) {
                                if (array_key_exists('images', $group)) {
                                    foreach ($group as $item_name => $item) {
                                        if ($item_name === 'images') {
                                            foreach ($item as $key => $value) {
                                                fwrite($resize_file, resize_wrap::resizeWrap($group_name, $value));
                                            }
                                            $msg = $msg . 'Ресайз сгенерирован  ' . $item_name . '</br>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $msg = $msg . 'Ресайз сгенерирован  ' . $block_name . '</br>';
            }
        }

        fwrite($resize_file, '\'images_set_text_pict\'=>[' . PHP_EOL);
        fwrite($resize_file, '\'sizes\' => []' . PHP_EOL);
        fwrite($resize_file, '],' . PHP_EOL . PHP_EOL);
        fwrite($resize_file, '];' . PHP_EOL);

        fclose($resize_file);
        chmod(public_path() . '/../config/resize.php', 0777);

        return $msg;
    }


}