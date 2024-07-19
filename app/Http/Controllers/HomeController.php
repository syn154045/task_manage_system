<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $taskCount = Task::where('completion_status', 0)->count();

        return view('home', compact('taskCount'));
    }
}
