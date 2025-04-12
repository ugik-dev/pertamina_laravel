<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Screening;
use App\Models\Sebuse;
use App\Models\User;
use App\Models\Workout;
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
        $faker = Faker::create();

        Field::create(['name' => "Ketinggian"]);
        Field::create(['name' => "Satpam"]);
        $admin = User::updateOrCreate(
            [
                'username' => 'fersi',
                'name' => 'Muhammad Fersi Pratama',
                'qrcode' => 'd3286f12-a0ab-45a7-aba9-11b7e15f4723',
                'email' => 'fersi@example.com',
                'password' => Hash::make('123'),
                'role_id' => 1,
                // 'field_work_id' => $faker->numberBetween(1, 2),
            ],
        );
        $role = Role::findOrFail(1);
        $admin->assignRole($role);


        $role = Role::where('name', 'staf')->firstOrFail();
        for ($i = 0; $i < 34; $i++) {
            $username = $faker->userName;
            $username = strtolower($username);
            $username = preg_replace('/[^a-z0-9]/', '', $username);
            $user = User::updateOrCreate(
                [
                    // 'username' => $username,
                    'qrcode' => $username,
                    'name' => $faker->name,
                    'field_work_id' => $faker->numberBetween(1, 2),
                    'email' => $faker->unique()->safeEmail,
                    'dob' => $faker->dateTimeBetween('-60 years', '-18 years'),
                    // 'password' => Hash::make('123'),
                    'role_id' => $role->id
                ]
            );

            // Assign role to the user
            $user->assignRole($role);

            // }
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addMonth();

            for ($j = 0; $j < 30; $j++) {
                Screening::create([
                    'user_id' => $user->id,
                    'doctor_id' => $admin->id, // doctor_id is ugikdev
                    'sistole' => $faker->numberBetween(70, 160),
                    'diastole' => $faker->numberBetween(50, 120),
                    'hr' => $faker->numberBetween(49, 150),
                    'temp' => $faker->numberBetween(25, 48),
                    'rr' => $faker->numberBetween(8, 34),
                    'spo2' => $faker->numberBetween(60, 110),
                    'romberg' => $faker->randomElement(['Y', 'N']),
                    'alcohol' => $faker->randomElement(['Y', 'N']),
                    'fitality' => $faker->randomElement(['Y', 'N']),
                    'alcohol_level' => $faker->numberBetween(0, 100),
                    'fisik' => $faker->randomElement(['baik', 'umum', 'buruk']),
                    'created_at' => Carbon::create(2024, 9, 1 + $j), // Start from October 1, 2023
                    'updated_at' => Carbon::create(2024, 9, 1 + $j),
                ]);

                Sebuse::create([
                    'user_id' => $user->id,
                    'kal_val' => $faker->numberBetween(70, 160),
                    'kal_attch' => $faker->randomElement(['upload/sebuse/kalori/1728421246_Putra_01-10-2024_20.42_signed.pdf', 'upload/sebuse/streching/1728421246_Putra_01-10-2024_20.42_signed.pdf', null, null, null, null]),
                    'str_attch' => $faker->randomElement(['upload/sebuse/kalori/1728421246_Putra_01-10-2024_20.42_signed.pdf', 'upload/sebuse/streching/1728421246_Putra_01-10-2024_20.42_signed.pdf', null, null, null]),
                    'gym_attch' => $faker->randomElement(['upload/sebuse/kalori/1728421246_Putra_01-10-2024_20.42_signed.pdf', 'upload/sebuse/streching/1728421246_Putra_01-10-2024_20.42_signed.pdf', null, null, null]),
                    'created_at' => Carbon::create(2024, 10, 1 + $j), // Start from October 1, 2023
                    'updated_at' => Carbon::create(2024, 10, 1 + $j),
                ]);

                $date = Carbon::parse($startDate)->addDays(rand(0, 30));

                Workout::create([
                    'user_id' => $user->id, // sesuaikan dengan user yang ada
                    'verif_id' => $admin->id, // sesuaikan juga
                    'description' => 'Workout ke-' . ($i + 1),
                    'hours' => rand(0, 2),
                    'minutes' => rand(0, 59),
                    'seconds' => rand(0, 59),
                    'km_tempuh' => rand(1, 10),
                    'workout_jenis' =>  $faker->randomElement(['Lari', 'Sepeda', 'Jalan']),
                    'verif_status' => rand(0, 1) ? 'Y' : 'N',
                    'evi_attch' => null,
                    'evi_status' => rand(0, 1) ? 'Y' : 'N',
                    'created_at' => $date,
                    'updated_at' => $date,
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
