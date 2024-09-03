<?php

namespace Database\Seeders;

use App\Models\LoginSession;
use App\Models\RequestCall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DumyCallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i < 100; $i++) {
            $p = LoginSession::insertGetId(['name' => 'Pengguna' . $i, 'phone' => '08' . $i]);
            // $id  = $p->id();

            for ($j = 1; $j < 3; $j++) {
                $randomCoordinates = $this->generateRandomCoordinates();
                RequestCall::create(['login_session_id' => $p, 'ref_emergency_id' => rand(1, 6), 'status' => '1', 'long' => $randomCoordinates['long'], 'lat' => $randomCoordinates['lat']]);
            }
        }

        $sqlFilePath = database_path('seeders/sql/contents.sql');
        if (file_exists($sqlFilePath)) {
            $sqlContent = file_get_contents($sqlFilePath);
            DB::unprepared($sqlContent);
        } else {
            echo "SQL file not found at $sqlFilePath\n";
        }

        $sqlFilePath = database_path('seeders/sql/faskes.sql');
        if (file_exists($sqlFilePath)) {
            $sqlContent = file_get_contents($sqlFilePath);
            DB::unprepared($sqlContent);
        } else {
            echo "SQL file not found at $sqlFilePath\n";
        }

        $sqlFilePath = database_path('seeders/sql/live_locations.sql');
        if (file_exists($sqlFilePath)) {
            $sqlContent = file_get_contents($sqlFilePath);
            DB::unprepared($sqlContent);
        } else {
            echo "SQL file not found at $sqlFilePath\n";
        }
    }

    function generateRandomCoordinates($maxDistance = 10)
    {
        // Earth's radius in kilometers
        $referenceLat = -1.874219;
        $referenceLng = 106.096427;
        $earthRadius = 6371;

        $referenceLatRad = deg2rad($referenceLat);
        $referenceLngRad = deg2rad($referenceLng);

        $randomDistance = mt_rand(0, $maxDistance);
        $randomAngle = deg2rad(mt_rand(0, 360));

        $newLatRad = asin(sin($referenceLatRad) * cos($randomDistance / $earthRadius) +
            cos($referenceLatRad) * sin($randomDistance / $earthRadius) * cos($randomAngle));

        $newLngRad = $referenceLngRad + atan2(
            sin($randomAngle) * sin($randomDistance / $earthRadius) * cos($referenceLatRad),
            cos($randomDistance / $earthRadius) - sin($referenceLatRad) * sin($newLatRad)
        );

        $newLat = rad2deg($newLatRad);
        $newLng = rad2deg($newLngRad);
        return ['lat' => $newLat, 'long' => $newLng];
    }
}
