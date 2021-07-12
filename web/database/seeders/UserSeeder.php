<?php

namespace Database\Seeders;

use App\Models\RoleHierarchy;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 100;
        $userStatus = array(
            'Active',
            'Inactive',
            'Pending',
            'Banned'
        );

        /* Create roles */
        $adminRole = $roleAdmin = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $guestRole = Role::create(['name' => 'guest']);

        $faker = Faker::create();
        /*  insert users   */
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => 'Active'
        ]);
        $user->assignRole('user');
        $user->assignRole($roleAdmin);

        for($i = 0; $i<$numberOfUsers; $i++){
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'status' => $userStatus[ random_int(0,count($userStatus) - 1) ]
            ]);
            $user->assignRole('user');
        }
    }
}
