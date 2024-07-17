<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * 商品情報 list
     */
    public function list(Request $request)
    {
        $res = $this->item->select('id', 'name', 'code', 'type', 'updated_at')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'desc')
        ->get();

        return view ('contents/items/list', compact('res'));
    }

    /**
     * 商品情報 登録画面
     */
    public function new()
    {
        return view('contents/items/unit');
    }

    /**
     * 商品情報 登録
     */
    public function store(Request $request)
    {
        $attributes = $request->only(['name', 'code', 'type', 'description']);
        $attributes['id'] = Str::ulid();
        // dd($attributes);

        try {
            DB::beginTransaction();
            $this->item->create($attributes);
            DB::commit();
            return redirect()->route('item.list')->with(['message' => '登録しました']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors(['err' => 'エラーが発生しました：' . $e->getMessage()]);
        }
    }


    /**
     * 商品情報 編集画面
     */
    public function edit($id)
    {
        $res = $this->item->where('id', $id)
        ->first();

        return view ('contents/items/unit', compact('res'));
    }

    /**
     * 商品更新
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->only(['name', 'code', 'type', 'description']);
        // dd($id);

        try {
            DB::beginTransaction();
            $this->item->where('id', $id)
                ->whereNull('deleted_at')->update($attributes);
            DB::commit();
            return redirect()->route('item.list')->with(['message' => '更新しました']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors(['err' => 'エラーが発生しました：' . $e->getMessage()]);
        }
    }


    /**
     * 商品削除
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->item->where('id', $id)
            ->whereNull('deleted_at')->delete();
            DB::commit();
            return redirect()->route('item.list')->with(['message' => '削除しました']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors(['err' => 'エラーが発生しました：' . $e->getMessage()]);
        }
    }
}
