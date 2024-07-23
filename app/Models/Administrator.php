<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable, HasUlids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function register($req)
    {
        $this->name = $req["name"];
        $this->email = $req["email"];
        $this->password = Hash::make($req["password"]);
        $this->save();
        return $this;
    }

    public function findByEmail($email)
    {
        return self::where('email', $email)->first();
    }
}
