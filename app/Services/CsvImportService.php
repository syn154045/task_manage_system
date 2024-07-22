<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class CsvImportService
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function import($file)
    {
        try {
            $filePath = $file->getrealPath();

            // ファイルの内容を読み込む
            $content = file_get_contents($filePath);
            // 文字コード検出
            $encoding = $this->detectEncoding($content);

            // UTF-8以外の場合、UTF-8に変換
            if ($encoding && $encoding !== 'UTF-8') {
                $content = $this->convertToUTF8($content, $encoding);
                // 変換した内容を一時ファイルに書き込む -> 読込先を一時ファイルに変更
                $tempFilePath = tempnam(sys_get_temp_dir(),'csv_');
                file_put_contents($tempFilePath, $content);
                $filePath = $tempFilePath;
            }

            $file = fopen($filePath, 'r');
            $header = fgetcsv($file);

            while ($columns = fgetcsv($file)) {
                $data = array_combine($header, $columns);
                $id = Str::ulid();
                $this->order->create([
                    'id' => $id,
                    'shop_name' => $data['shop_name'],
                    'order_detail' => $data['order_detail'] ?? null,
                ]);
            }
            fclose($file);

            // 一時ファイルを削除
            if (isset($tempFilePath)) {
                unlink($tempFilePath);
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }


    /**
     * 文字コード検出
     */
    protected function detectEncoding($string) {
        $encodings = ['UTF-8', 'SJIS', 'EUC-JP', 'ISO-2022-JP'];
        foreach ($encodings as $encoding) {
            if (mb_check_encoding($string, $encoding)) {
                return $encoding;
            }
        }
        return false;
    }
    /**
     * 文字コード変換
     */
    protected function convertToUTF8($string, $fromEncoding) {
        if ($fromEncoding === 'UTF-8') {
            return $string;
        }
        return mb_convert_encoding($string, 'UTF-8', $fromEncoding);
    }
}
