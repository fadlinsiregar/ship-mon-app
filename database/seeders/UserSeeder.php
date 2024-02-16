<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            ['id' => 1, 'full_name' => 'John Doe', 'role_id' => 1, 'username' => 'johndoe', 'password' => Hash::make('password'), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'full_name' => 'Jane Doe', 'role_id' => 2, 'username' => 'janedoe', 'password' => Hash::make('password'), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'full_name' => 'Juan', 'role_id' => 2, 'username' => 'juan', 'password' => Hash::make('password'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
