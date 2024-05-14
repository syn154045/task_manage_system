<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * ホーム画面表示
     * @return View
     */
    public function index()
    {
        return view('home');
    }
}
