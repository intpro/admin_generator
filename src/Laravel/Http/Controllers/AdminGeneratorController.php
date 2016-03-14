<?php namespace Interpro\AdminGenerator\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Interpro\AdminGenerator\Laravel\AdminGenerator;

class AdminGeneratorController extends Controller
{

    // Сгенерировать весь конфиг
    public function generateAll()
    {
        try{
        $generator = new AdminGenerator;
            $generator->MakeDirectory();
        $config = config('qstorage');
        $msg = '';
        foreach($config as $key=>$value) {
            $generator->makeBlock($key);
            $msg = $msg.'Блок сгенерирован  ' . $key . '</br>';
        }
            return $msg;
        }catch(\Exception $exception){
            return 'Что то пошло не так'.$exception->getMessage();
        }
    }
    // Сгенерировать один блок
    public function generateBlock($block)
    {
        try{
            $generator = new AdminGenerator;
            $generator->MakeDirectory();
            $generator->makeBlock($block);
            return 'Блок сгенерирован  ' . $block . '</br>';
        }catch(\Exception $exception){
            return 'Что то пошло не так'.$exception->getMessage();
        }

    }

}