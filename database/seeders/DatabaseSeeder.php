<?php

namespace Database\Seeders;

use App\Models\Contractor;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
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
//         User::factory(10)->create();

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

        # Statuses
        Status::create(['name' => 'NOT STARTED']);
        Status::create(['name' => 'ONGOING']);
        Status::create(['name' => 'ON HOLD']);
        Status::create(['name' => 'DONE']);
        Status::create(['name' => 'DELAY']);

        # Test Tasks
        Task::factory(10)->create();

        # Null Contractor
        Contractor::create(['name' => 'Без контрагента']);
//        Contractor::factory(100)->create();
    }
}
