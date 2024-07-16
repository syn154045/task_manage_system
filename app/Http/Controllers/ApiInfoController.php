<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiInfoController extends Controller
{
    /**
     * API情報管理 list
     */
    public function list()
    {
        return view ('contents/apiInfo/list');
    }


    /**
     * API情報管理 detail
     */
    public function detail()
    {
        return view ('contents/apiInfo/detail');
    }
}
