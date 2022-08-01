<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MyController extends Controller
{

    protected $menu;
    public function __construct()
    {
        $this->menu=Menu::all();
    }
}
