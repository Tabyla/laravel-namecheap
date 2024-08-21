<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Services\NamecheapService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Random\RandomException;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            'name' => 'Tabyla',
            'email' => 'sashaperezhogin123@gmail.com',
            'password' => Hash::make('admin'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('namecheap_profiles')->insert([
            'user_id' => 1,
            'surname' => 'Александр',
            'firstname' => 'Пережогин',
            'api_key' => '7d53046fb9fa44bcb96a06c5dee6ef57',
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('namecheap_profiles')->insert([
            'user_id' => 2,
            'surname' => 'User',
            'firstname' => 'User',
            'api_key' => '7d53046fb9fa44bcb96a06c5dee6ef57',
        ]);
    }
}
