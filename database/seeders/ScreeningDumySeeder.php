<?php

namespace Database\Seeders;

use App\Models\Screening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ScreeningDumySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $batchSize = 1000; // Jumlah data per batch
        $totalRecords = 1000; // Total data yang ingin dimasukkan

        // Menggunakan DB::table untuk efisiensi
        $screenings = [];
        for ($i = 0; $i < $totalRecords; $i++) {
            $screenings[] = [
                'doctor_id' => 1,
                'user_id' => $faker->numberBetween(1, 34),
                'sistole' => $faker->numberBetween(70, 100),
                'diastole' => $faker->numberBetween(40, 120),
                'fisik' => 'baik',
                'hr' => $faker->numberBetween(40, 150),
                'temp' => $faker->numberBetween(32, 42),
                'rr' => $faker->numberBetween(8, 29),
                'spo2' => $faker->optional()->numberBetween(70, 120),
                'romberg' => $faker->randomElement(['Y', 'N']),
                'alcohol' => $faker->randomElement(['Y', 'N']),
                'fitality' => $faker->randomElement(['Y', 'N']),
                'alcohol_level' => $faker->optional()->numberBetween(0, 100),
                // 'anamnesis' => $faker->optional()->text,
                // 'description' => $faker->optional()->text,
                'created_at' => now(),
                'updated_at' => now(),
            ];


            // Insert data in batches
            if (($i + 1) % $batchSize === 0) {
                DB::table('screenings')->insert($screenings);
                $screenings = []; // Clear the array for next batch
            }
        }

        // Insert any remaining records
        if (!empty($screenings)) {
            DB::table('screenings')->insert($screenings);
        }
    }
}
