<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DumpController;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\View\View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index():View
    {
        $images = Image::orderBy('id','desc')->simplePaginate(3);
        //DumpController::showArray($image);
        return view('home', [
            'images' => $images
        ]);
    }
    
}
