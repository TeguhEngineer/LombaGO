<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            ['name' => 'Super Admin','jk' => 'Laki-laki', 'no_tlp' => '000000000000', 'asal_sekolah' => 'LP3I Tasikmalaya', 'email' => 'superadmin@gmail.com', 'password' => bcrypt('password#123'), 'role' => 'superadmin'],
            ['name' => 'M.Aripin S.Kom','jk' => 'Laki-laki', 'no_tlp' => '000000000000', 'asal_sekolah' => 'LP3I Tasikmalaya', 'email' => 'emailpakaripin@gmail.com', 'password' => bcrypt('password'), 'role' => 'superadmin'],
        ]);
    }
}
