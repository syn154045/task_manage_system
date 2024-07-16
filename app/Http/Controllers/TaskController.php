<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * タスク状況 list
     */
    public function list()
    {
        return view ('contents/tasks/list');
    }


    /**
     * タスク状況 detail
     */
    public function detail()
    {
        return view ('contents/tasks/detail');
    }
}
