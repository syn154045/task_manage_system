<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class TaskController extends Controller
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * タスク状況 list（未終了のみ）
     */
    public function list(Request $request)
    {
        // 完了済リストビュー判定
        $isCompleted = $request->route()->getName() === 'task.list-completed';

        $res = $this->task->with(['item', 'order'])
        ->whereNull('tasks.deleted_at')
        ->where('completion_status', $isCompleted ? 1 : 0)
        ->orderBy('tasks.updated_at', 'desc')
        ->join('items', 'tasks.item_id', '=', 'items.id')
        ->orderByRaw('items.type ASC, items.name ASC')
        ->select('tasks.*')
        ->get();

        // 商品タイプ (ALL)
        $itemTypes = Item::distinct()->pluck('type');
        // 商品タイプに紐づいたタスク数
        $typeCounts = Item::withCount('tasks')
        ->join('tasks', 'items.id', '=', 'tasks.item_id')
        ->where('tasks.completion_status', $isCompleted ? 1 : 0)
        ->get()
        ->groupBy('type');

        return view ('contents/tasks/list', compact('res', 'itemTypes', 'typeCounts', 'isCompleted'));
    }

    /**
     * タスク完了報告
     */
    public function completionReport(Request $request)
    {
        $taskIds = $request->input('task_ids', []);
        // dd($taskIds);
        if (!empty($taskIds)) {
            $this->task->whereIn('id', $taskIds)->update(['completion_status' => 1]);
            // mail send?

            return redirect()->route('task.list')->with(['message' => '完了報告しました']);
        }
        return redirect()->route('task.list')->withErrors(['err' => 'タスクが選択されていないか、エラーが発生しました']);
    }
}
