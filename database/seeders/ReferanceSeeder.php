<?php

namespace Database\Seeders;

use App\Models\RefContent;
use App\Models\RefJenFaskes;
use App\Models\RefLiveLocation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RefEmergency;

class ReferanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RefContent::updateOrCreate(['name' => 'Informasi']);
        RefContent::updateOrCreate(['name' => 'Berita']);
        RefContent::updateOrCreate(['name' => 'Pengumuman']);
        RefContent::updateOrCreate(['name' => 'Artikel']);

        RefJenFaskes::updateOrCreate(['name' => 'PSC 119', 'name_sort' => 'PSC']);
        RefJenFaskes::updateOrCreate(['name' => 'Dinas Kesehatan', 'name_sort' => 'DINKES']);
        RefJenFaskes::updateOrCreate(['name' => 'Rumah Sakit', 'name_sort' => 'RS']);
        RefJenFaskes::updateOrCreate(['name' => 'Puskesmas', 'name_sort' => 'PKM']);
        RefJenFaskes::updateOrCreate(['name' => 'Pustu', 'name_sort' => 'Pustu']);
        RefJenFaskes::updateOrCreate(['name' => 'Pos Kesehatan Desa', 'name_sort' => 'Poskesdes']);
        RefJenFaskes::updateOrCreate(['name' => 'Bidan', 'name_sort' => 'Bidan']);
        RefJenFaskes::updateOrCreate(['name' => 'Klinik', 'name_sort' => 'Klinik']);
        RefJenFaskes::updateOrCreate(['name' => 'Apotek', 'name_sort' => 'Apotek']);

        RefEmergency::updateOrCreate(['id' => 1, 'name' => 'PSC 119']);
        RefEmergency::updateOrCreate(['id' => 2, 'name' => 'Ambulan']);
        RefEmergency::updateOrCreate(['id' => 3, 'name' => 'Polisi']);
        RefEmergency::updateOrCreate(['id' => 4, 'name' => 'Damkar']);
        RefEmergency::updateOrCreate(['id' => 5, 'name' => 'Bidan']);
        RefEmergency::updateOrCreate(['id' => 6, 'name' => 'Tagana']);

        RefLiveLocation::updateOrCreate(['id' => '1', 'name' => 'Ambulan']);
        RefLiveLocation::updateOrCreate(['id' => '2', 'name' => 'Motor']);
    }
}
