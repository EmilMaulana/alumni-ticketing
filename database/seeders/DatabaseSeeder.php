<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $this->call(RolesTableSeeder::class);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Emil Maulana',
        //     'email' => 'emilmaulana10@gmail.com',
        // ]);
    }
}
