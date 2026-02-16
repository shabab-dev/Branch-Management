<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active'
            ],
            [
                'name' => 'Branch Manager',
                'username' => 'bmanager',
                'email' => 'bmanager@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'branch-manager',
                'status' => 'active'
            ],
        ];

        foreach ($users as $userData) {
                // 1. Create the User and get the ID
                $userId = DB::table('users')->insertGetId($userData);

                // 2. Get random data from the UserProfile factory definition
                // We use raw() to get the array of data without actually saving it to the DB yet
                $profileData = UserProfile::factory()->raw([
                    'user_id'    => $userId,
                    'first_name' => explode(' ', $userData['name'])[0],
                    'last_name'  => explode(' ', $userData['name'])[1] ?? 'System',
                    'email'      => $userData['email'], // Sync profile email with user email
                ]);

                // 3. Insert the combined data into user_profiles
                DB::table('user_profiles')->insert(array_merge($profileData, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
    }
}
