<?php

namespace App\View\Components\layouts;

use App\Models\Task;
use Illuminate\View\Component;

class admin extends Component
{
    private Task $task;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $taskCount = $this->task
        ->where('completion_status',0)
        ->count();

        return view('components.layouts.admin', compact('taskCount'));
    }
}
