<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * 商品情報 list
     */
    public function list()
    {
        return view ('contents/items/list');
    }


    /**
     * 商品情報 detail
     */
    public function detail()
    {
        return view ('contents/items/detail');
    }
}
