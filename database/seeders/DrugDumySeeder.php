<?php

namespace Database\Seeders;

use App\Models\Screening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DrugDumySeeder extends Seeder
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
                'name' => $faker->name(),
                'satuan' => $faker->randomElement(['btl', 'tb']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data in batches
            if (($i + 1) % $batchSize === 0) {
                DB::table('drugs')->insert($screenings);
                $screenings = []; // Clear the array for next batch
            }
        }

        // Insert any remaining records
        if (!empty($screenings)) {
            DB::table('screenings')->insert($screenings);
        }
    }
}
