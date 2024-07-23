<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super
        DB::table('administrators')->insert([
            'id' => Str::ulid(),
            'name' => '京都　舞子',
            'email' => 'admin000@example.com',
            'password' => Hash::make('pass!123'),
            'role' => 'super',
            'created_at' => CarbonImmutable::now(),
        ]);
        // admin
        DB::table('administrators')->insert([
            'id' => Str::ulid(),
            'name' => '京都　寺子',
            'email' => 'admin001@example.com',
            'password' => Hash::make('pass!123'),
            'role' => 'admin',
            'created_at' => CarbonImmutable::now(),
        ]);
    }
}
