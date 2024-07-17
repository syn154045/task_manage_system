<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    /**
     * 受注情報 list
     */
    public function list()
    {
        $res = $this->order->get();
        return view ('contents/orders/list', compact('res'));
    }


    /**
     * 受注情報 detail
     */
    public function detail()
    {
        return view ('contents/orders/detail');
    }
}
