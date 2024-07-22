<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Task;
use App\Services\CsvImportService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private Order $order;
    protected $csvImportService;

    public function __construct(Order $order, CsvImportService $csvImportService)
    {
        $this->order = $order;
        $this->csvImportService = $csvImportService;
    }


    /**
     * 受注情報 list
     */
    public function list()
    {
        $res = $this->order->select('id', 'shop_name', 'order_detail','created_at')
        ->whereNull('deleted_at')
        ->where('output_status', false)
        ->orderBy('created_at', 'desc')
        ->get();

        return view ('contents/orders/list', compact('res'));
    }


    /**
     * 受注情報 CSV取込
     */
    public function csvUpload(Request $request)
    {
        if (!$request->hasFile('csvFile')) {
            return redirect()->route('order.list')->withErrors(['err' => 'CSVファイルを選択してください']);
        }

        try {
            $file = $request->csvFile;
            $this->csvImportService->import($file);

            return redirect()->route('order.list')->with(['message' => 'CSVインポートが完了しました']);
        } catch (Exception $e) {
            return redirect()->route('order.list')->withErrors(['err' => 'CSVインポートに失敗しました']);
        }
    }


    /**
     * 受注情報 -> 全件印刷タスク出力
     */
    public function taskOutput(Request $request)
    {
        // 削除済・出力済以外の受注データ存在有無
        $orderExists = $this->order->whereNull('deleted_at')
        ->where('output_status', false)
        ->exists();

        if (!$orderExists) {
            return redirect()->route('order.list')->withErrors(['err' => '受注情報が空、もしくは全て出力済です']);
        }

        // 一度に実行する処理数
        $chunkSize = 100;

        try {
            DB::beginTransaction();

            $this->order->whereNull('deleted_at')
            ->where('output_status', false)
            ->chunk($chunkSize, function ($orders) {
                foreach ($orders as $order) {
                    // TODO: 分割方法
                    $orderDetailParts = explode('_', $order->order_detail);

                    // 不正なフォーマットの場合はスキップ
                    if (count($orderDetailParts) !== 2) {
                        Log::warning("invalid order_detail format: {$order->order_detail}");
                        continue;
                    }

                    $itemName = $orderDetailParts[0];
                    $printData = $orderDetailParts[1];

                    $item = Item::where('name', $itemName)->first();

                    // 一致するアイテムが無い場合はスキップ
                    if (!$item) {
                        Log::warning("Item not found: {$itemName}");
                        continue;
                    }

                    // taskテーブルに追加
                    Task::create([
                        'order_id' => $order->id,
                        'item_id' => $item->id,
                        'print_data' => $printData,
                    ]);

                    // orderテーブルのoutput_statusを変更
                    // dd($order);
                    $order->update(['output_status' => true]);
                }
            });

            DB::commit();
            return redirect()->route('order.list')->with(['message' => '受注情報をタスクに出力しました']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('order.list')->withErrors(['err' => '出力中にエラーが発生しました']);
        }
    }

    /**
     * 受注情報 詳細画面
     */
    public function edit(Request $request)
    {
        // 詳細を確認するのみであれば、メソッド名を"edit" -> "detail"に変更しても良いかも。適宜検討する
        dd($request);
    }

    /**
     * 受注情報 更新
     */
    public function update(Request $request)
    {
        // 更新の必要性があるか定かではない
        dd($request);
    }

    /**
     * 受注情報 削除
     */
    public function delete(Request $request)
    {
        // 個別に削除する必要があれば
        dd($request);
    }
}
