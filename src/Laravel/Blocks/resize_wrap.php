<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 22.04.2016
 * Time: 12:33
 */

namespace Interpro\AdminGenerator\Laravel\Blocks;


class resize_wrap
{

    public static function resizeWrap($name, $image)
    {
        $template = '\'' . $name . '_' . $image . '\'=> [' . PHP_EOL;
        $template .= '\'sizes\' => [' . PHP_EOL;
        $template .= '[\'width\'=>700, \'height\'=>null, \'sufix\'=>\'primary\'],' . PHP_EOL;
        $template .= '[\'width\'=>500, \'height\'=>null, \'sufix\'=>\'secondary\'],' . PHP_EOL;
        $template .= '[\'width\'=>100, \'height\'=>null, \'sufix\'=>\'preview\'],' . PHP_EOL;
        $template .= '[\'width\'=>100, \'height\'=>null, \'sufix\'=>\'icon\'],' . PHP_EOL;
        $template .= ']' . PHP_EOL . '],';

        return $template . PHP_EOL;

    }


}