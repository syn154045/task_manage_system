<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 受注情報 list
     */
    public function list()
    {
        return view ('contents/orders/list');
    }


    /**
     * 受注情報 detail
     */
    public function detail()
    {
        return view ('contents/orders/detail');
    }
}
