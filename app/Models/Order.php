<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;

    protected $casts = [
        'output_status' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'shop_name',
        'order_detail',
        'output_status',
    ];

    // public static function booted()
    // {
    //     static::deleted(function ($order) {
    //         $order->tasks()->delete();
    //     });
    // }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'order_id', 'id');
    }
}
