<?php

namespace Database\Seeders;

use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            [
                'username' => 'fersi',
                'name' => 'Muhammad Fersi Pratama',
                'qrcode' => 'd3286f12-a0ab-45a7-aba9-11b7e15f4723',
                'email' => 'fersi@example.com',
                'password' => Hash::make('123'),
                'role_id' => 1
            ],
        );
        $role = Role::findOrFail(1);
        $admin->assignRole($role);


        $faker = Faker::create();
        $role = Role::where('name', 'staf')->firstOrFail();
        for ($i = 0; $i < 15; $i++) {
            $username = $faker->userName;
            $username = strtolower($username);
            $username = preg_replace('/[^a-z0-9]/', '', $username);
            $user = User::updateOrCreate(
                [
                    // 'username' => $username,
                    'qrcode' => $username,
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    // 'password' => Hash::make('123'),
                    'role_id' => $role->id
                ]
            );

            // Assign role to the user
            $user->assignRole($role);

            // }

            for ($j = 0; $j < 7; $j++) {
                Screening::create([
                    'user_id' => $user->id,
                    'doctor_id' => $admin->id, // doctor_id is ugikdev
                    'sistole' => $faker->numberBetween(90, 140),
                    'diastole' => $faker->numberBetween(60, 100),
                    'hr' => $faker->numberBetween(60, 120),
                    'temp' => $faker->numberBetween(35, 38),
                    'rr' => $faker->numberBetween(12, 24),
                    'spo2' => $faker->numberBetween(90, 100),
                    'romberg' => $faker->randomElement(['Y', 'N']),
                    'alcohol' => $faker->randomElement(['Y', 'N']),
                    'fitality' => $faker->randomElement(['Y', 'N']),
                    'alcohol_level' => $faker->numberBetween(0, 100),
                    'fisik' => $faker->randomElement(['baik', 'umum', 'buruk']),
                    'created_at' => Carbon::create(2024, 9, 1 + $j), // Start from October 1, 2023
                    'updated_at' => Carbon::create(2024, 9, 1 + $j),
                ]);
            }
            Screening::create([
                'user_id' => $user->id,
                'doctor_id' => $admin->id, // doctor_id is ugikdev
                'sistole' => $faker->numberBetween(90, 140),
                'diastole' => $faker->numberBetween(60, 100),
                'hr' => $faker->numberBetween(60, 120),
                'temp' => $faker->numberBetween(35, 38),
                'rr' => $faker->numberBetween(12, 24),
                'spo2' => $faker->numberBetween(90, 100),
                'romberg' => $faker->randomElement(['Y', 'N']),
                'alcohol' => $faker->randomElement(['Y', 'N']),
                'fitality' => $faker->randomElement(['Y', 'N']),
                'alcohol_level' => $faker->numberBetween(0, 100),
                'fisik' => $faker->randomElement(['baik', 'umum', 'buruk']),
            ]);
        }
    }
}
