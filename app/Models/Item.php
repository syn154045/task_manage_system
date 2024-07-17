<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        "id",
        "name",
        "code",
        "type",
        "description",
    ];

    // public static function booted()
    // {
    //     static::deleted(function ($item) {
    //         $item->tasks()->delete();
    //     });
    // }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'item_id', 'id');
    }
}
