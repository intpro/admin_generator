<?php

namespace Interpro\AdminGenerator\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Interpro\AdminGenerator\Laravel\ResizeGenerator;

class ResizeGeneratorController extends Controller
{

    public function generateResize()
    {
        try{
            $generator = new ResizeGenerator;
            $msg = $generator->makeResize();
            return $msg;
        }catch(\Exception $exception){
            return 'Что то пошло не так'.$exception->getMessage();
        }
    }

}