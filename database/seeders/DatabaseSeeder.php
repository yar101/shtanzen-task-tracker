<?php

namespace Database\Seeders;

use App\Imports\UsersImportEqp;
use App\Models\Comment;
use App\Models\Contractor;
use App\Models\Department;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         UserComponent::factory(10)->create();

//        UserComponent::factory()->create([
//            'name' => 'Test UserComponent',
//            'email' => 'test@example.com',
//        ]);

        #Create roles
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'head-of-department']);
        Role::create(['name' => 'head-of-company']);

        # Departments
        Department::create(['name' => 'Без отдела']);
        Department::create(['name' => 'Инструменты']);
        Department::create(['name' => 'Логистика']);

        # Create admin
        User::create([
            'name' => 'admin',
            'role_id' => 2, #admin role id'
            'email' => 'yakimec@stnzn.ru',
            'password' => Hash::make('RedAndWhite1!'),
        ]);

//        UserComponent::create([
//            'name' => 'hod-ob',
//            'role_id' => '3', #head-of-department role id
//            'email' => 'hod-otd@stnzn.ru',
//            'password' => Hash::make('RedAndWhite1!'),
//            'department_id' => 2,
//        ]);

//        UserComponent::create([
//            'name' => 'man1',
//            'role_id' => '2', #user role id
//            'email' => 'man1@stnzn.ru',
//            'password' => Hash::make('RedAndWhite1!'),
//            'department_id' => 2,
//        ]);
//
//        UserComponent::create([
//            'name' => 'man2',
//            'role_id' => '2', #user role id
//            'email' => 'man2@stnzn.ru',
//            'password' => Hash::make('RedAndWhite1!'),
//            'department_id' => 2,
//        ]);
//
//        UserComponent::create([
//           'name' => 'man3',
//           'role_id' => '2', #user role id
//           'email' => 'man3@stnzn.ru',
//           'password' => Hash::make('RedAndWhite1!'),
//           'department_id' => 3,
//        ]);

        # Statuses
        Status::create(['name' => 'NOT STARTED']);
        Status::create(['name' => 'ONGOING']);
        Status::create(['name' => 'ON HOLD']);
        Status::create(['name' => 'DONE']);
        Status::create(['name' => 'DELAY']);

        # Test Tasks
//        Task::factory(10)->create();

        # Null Contractor
        Contractor::create(['name' => 'Без контрагента']);
//        Contractor::factory(100)->create();
        # Comments
//        Comment::factory(100)->create();

        Excel::import(new UsersImportEqp, 'users_eqp.xlsx');
        $users = User::all();

        foreach ($users as $user) {
            if ($user->name == 'Евгений') {
                $user->update(['role_id' => 3]);
            }
        }
    }
}
