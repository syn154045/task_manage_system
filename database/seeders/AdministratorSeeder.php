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
        DB::table('administrators')->insert([
            'id' => Str::ulid(),
            'name' => '京都　舞子',
            'email' => 'admin000@example.com',
            'password' => Hash::make('pass!123'),
            'created_at' => CarbonImmutable::now(),
        ]);
    }
}
