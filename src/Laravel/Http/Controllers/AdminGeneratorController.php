<?php namespace Interpro\AdminGenerator\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Interpro\AdminGenerator\Laravel\AdminGenerator;

class AdminGeneratorController extends Controller
{

    public function index()
    {
        $generator =new AdminGenerator;
        return $generator->makeBlock('block');

    }

}