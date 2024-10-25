<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        #Create roles
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'head-of-department']);


        # Create admin
        User::create([
            'name' => 'admin',
            'role_id' => '1', #admin role id'
            'email' => 'yakimec@stnzn.ru',
            'password' => Hash::make('RedAndWhite1!'),
        ]);
    }
}
