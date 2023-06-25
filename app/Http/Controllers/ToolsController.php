<?php 
namespace App\Http\Controllers;

// CLASE PARA FARLE FORMATO LEGIBLE A LOS ARRAYS
class ToolsController
{
    public static function showArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}