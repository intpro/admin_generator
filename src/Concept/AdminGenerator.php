<?php
/**
 * Created by PhpStorm.
 * User: KocaHocTpa
 * Date: 03.03.2016
 * Time: 17:24
 */

namespace Interpro\AdminGenerator\Concept;

use Illuminate\Config;

interface AdminGenerator{

    public function makeAll();

    public function makeBlock($blockname);

    public function makeGroup($blockname,$groupname);

    public function getInvertGroupsStruct($group_config);
}