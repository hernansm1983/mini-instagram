<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DumpController extends Controller
{
    public static function showArray($array){
        
        echo "<pre>";
        var_dump($array);
        echo "</pre>";
    }
}
