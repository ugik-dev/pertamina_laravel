<?php

namespace App\Http\Controllers;

use App\Models\Populate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade untuk transaction
use Illuminate\Support\Facades\Validator;
use App\Helpers\DataStructure;
use App\Models\Labor;
use App\Models\LaborService;
use App\Models\PopulateBatch;
use App\Models\PopulateReview;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as SpreadsheetException;


class PopulateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refUser' => User::select('id', 'name')->get(),
        ];
        return view('page.populate.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  Populate::with(['uploadedBy'])->withCount('batches');
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->get()->toArray();
            $data =   DataStructure::keyValueObj($res, 'id', NULL, TRUE);

            return $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function detail(Request $request, int $id)
    {
        $dataContent =  [
            'id' => $id,
            'paramPOPULATE' => getParamPopulate(),
            'filter' => $this->getFilter($id),
            'laborServices' => LaborService::get()->toArray()
        ];
        return view('page.populate.detail', compact('request', 'dataContent'));
    }

    function getFilter(int $id)
    {
        $batch = PopulateBatch::where('populate_id', '=', $id)->get();
        $filter['divisi'] = $this->pluckFieldOption($batch, 'divisi');
        $filter['sub_division'] = $this->pluckFieldOption($batch, 'sub_division');
        $filter['personnel_subarea_name'] = $this->pluckFieldOption($batch, 'personnel_subarea_name');
        $filter['sub_area_large'] = $this->pluckFieldOption($batch, 'sub_area_large');
        $filter['departemen'] = $this->pluckFieldOption($batch, 'departemen');
        $filter['labor'] = Labor::get()->toArray();
        return $filter;
    }

    public function fetch_detail(Request $request, int $id)
    {
        try {
            $filter = $request->input();
            // dd($filter);
            $query =  Populate::with(['uploadedBy']);
            $query->where('id', '=', $id);
            // if (!empty($filter['provider']))
            //     $query->whereIn('lokasi', $filter['provider']);

            $res = $query->first();

            $queryBatch = PopulateBatch::where('populate_id', '=', $id);
            if (!empty($filter['provider']))
                $queryBatch->whereIn('lokasi', $filter['provider']);
            if (!empty($filter['ekg']))
                $queryBatch->whereIn('ekg', $filter['ekg']);
            if (!empty($filter['kardio']))
                $queryBatch->whereIn('risiko_cardiovascular_skj', $filter['kardio']);
            if (!empty($filter['bmi']))
                $queryBatch->whereIn('status_gizi', $filter['bmi']);
            $batch = $queryBatch->get();
            // dd($batch);
            // $statis['gender'] = [
            //     'Laki-laki' => $batch->where('jenis_kelamin', 'Laki-laki')->count(),
            //     'Perempuan' => $batch->where('jenis_kelamin', 'Perempuan')->count(),
            // ];

            // Usia
            $rentangUsia = [
                '< 20' => [0, 19],
                '20-25' => [20, 25],
                '25-30' => [25, 30],
                '30-35' => [30, 35],
                '35-40' => [35, 40],
                '40-45' => [40, 45],
                '45-50' => [45, 50],
                '50-55' => [50, 55],
                '55-60' => [55, 60],
                '> 60' => [60, PHP_INT_MAX],
            ];
            // dd($rentangUsia);
            // Inisialisasi array untuk menyimpan jumlah peserta per kelompok usia
            $chartByUsia = array_fill_keys(array_keys($rentangUsia), 0);

            // Kelompokkan usia ke dalam rentang yang telah didefinisikan
            foreach ($batch as $peserta) {
                $tanggalLahir = $peserta->tgl_lahir; // Ambil tanggal lahir
                $usia = Carbon::parse($tanggalLahir)->age; // Hitung usia

                foreach ($rentangUsia as $label => $range) {
                    if ($usia >= $range[0] && $usia <= $range[1]) {
                        $chartByUsia[$label]++;
                        break;
                    }
                }
            }
            // Grouping by lokasi
            // $batch->transform(function ($item) {
            //     $item->lokasi = str_replace(['Laboratorium', ','], ['Lab', ''], $item->lokasi);
            //     return $item;
            // });
            // $lokasiData = $batch->groupBy('lokasi')->map->count();
            // $byLokasi['data'] = $batch->groupBy('lokasi')->map->count()->sortByDesc(function ($count) {
            //     return $count;
            // });;
            // $byLokasi['categories'] = $lokasiData->keys()->toArray(); // Nama-nama lokasi
            // $byLokasi['values'] = $lokasiData->values()->toArray();
            // $jenisKesimpulan = ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'];

            // $hasil = $batch->reduce(function ($carry, $item) {
            //     if (empty($item->review->status_derajat_kesehatan)) {
            //         return $carry;
            //     }
            //     $key = $item->review->status_derajat_kesehatan;
            //     if ($key) {
            //         $carry[$key] = ($carry[$key] ?? 0) + 1;
            //     }
            //     return $carry;
            // }, []);

            // Susun data agar urut sesuai jenisKesimpulan
            // $dataKesimpulan = [];
            // foreach ($jenisKesimpulan as $jenis) {
            //     $dataKesimpulan[] = $hasil[$jenis] ?? 0;
            // }

            // $chartKesimpulan = [
            //     'jenis_kesimpulan' => $jenisKesimpulan,
            //     'values' => $dataKesimpulan,
            // ];
            // $merokok = [
            //     'Ya' => $batch->filter(function ($item) {
            //         return stripos($item->merokok, 'ya') !== false;
            //     })->count(),

            //     'Tidak' => $batch->filter(function ($item) {
            //         return stripos($item->merokok, 'ya') === false;
            //     })->count(),
            // ];
            // $kardio = $this->pluckField($batch, 'risiko_cardiovascular_skj');
            // $ekg = $this->pluckField($batch, 'ekg');
            // $bmi = $this->pluckField($batch, 'status_gizi');
            // dd($bmi);


            // $statis['kesimpulan'] = $chartKesimpulan;
            // $statis['usia'] = $chartByUsia;
            // $statis['lokasi'] = $byLokasi;
            // $statis['kardio'] = $kardio;
            // $statis['ekg'] = $ekg;
            // $statis['bmi'] = $bmi;
            // $statis['merokok'] = $merokok;
            // $res['statis'] = $statis;
            $res['batches'] = $batch;
            return $this->responseSuccess($res);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
    private function pluckFieldOption($collection, $field)
    {
        return $collection
            ->pluck($field)       // Ambil semua nilai kolom
            ->filter()            // Buang null/false/empty
            ->unique()            // Hapus duplikat
            ->values()            // Reset indeks biar rapi
            ->toArray();          // Ubah ke array biasa
    }
    function pluckField($db, $fieldname)
    {
        $fields = [];

        // Ambil semua nilai field, lalu normalisasi (tanpa duplikat)
        $uniqueField = $db->pluck($fieldname)->map(function ($item) {
            return is_null($item) || trim($item) === ''
                ? 'Lainnya'
                : ucwords(strtolower(trim($item)));
        })->unique();

        // Hitung berdasarkan versi normalisasi
        foreach ($uniqueField as $label) {
            if ($label === 'Lainnya') {
                $count = $db->filter(function ($item) use ($fieldname) {
                    $val = $item->$fieldname;
                    return is_null($val) || trim($val) === '';
                })->count();
            } else {
                $count = $db->filter(function ($item) use ($fieldname, $label) {
                    $val = $item->$fieldname;
                    return ucwords(strtolower(trim($val))) === $label;
                })->count();
            }

            $fields[$label] = $count;
        }

        return $fields;
    }

    function toSnakeCase($string)
    {
        $string = str_replace(['/', '(', ')'], '_', $string);
        $string = preg_replace('/[^a-zA-Z0-9 _]/', '', $string);
        $string = trim($string, " _");
        $string = preg_replace('/\s+/', '_', $string);
        $string = preg_replace('/_+/', '_', $string);
        return strtolower($string);
    }



    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validasi file Excel
            $request->validate([
                'file_attachment' => 'required|file|mimes:xlsx,xls',
                'sheet_name' => 'string',
            ]);

            // Baca file Excel
            $file = $request->file('file_attachment');
            $spreadsheet = IOFactory::load($file->getPathname());

            // Ambil sheet "POPULATE Sheet 2"
            $sheet = $spreadsheet->getSheetByName($request->sheet_name ?? "Sheet1");
            // dd($sheet);
            if (!$sheet) {
                throw new Exception("Sheet tidak ditemukan dalam file Excel.");
            }


            // cek tipe excel date
            $formatCode = $sheet->getStyle('G3')->getNumberFormat()->getFormatCode();

            // dd("create", $formatCode);

            // Konversi sheet ke array
            $data = $sheet->toArray();
            // dd(getHeaderPopulate());

            // Ambil header dari baris pertama
            $header = $data[1];
            $data = array_slice($data, 2);
            $headerPopulate = array_map('toSnakeCase', getHeaderPopulate());

            $snakeCaseHeader = array_map('toSnakeCase', $header);
            foreach ($headerPopulate as $hm) {
                if (!in_array($hm, $snakeCaseHeader)) {
                    throw new Exception("Header '$hm' tidak ditemukan di file Excel.");
                }
            }

            $headerIndexMap = array_flip($snakeCaseHeader);
            // dd($headerIndexMap);
            // Ambil index kolom yang diperlukan
            $requiredIndexes = [];
            $requiredIndexesReviews = [];
            foreach ($headerPopulate as $hm) {
                $requiredIndexes[$hm] = $headerIndexMap[$hm];
            }
            $formattedData = [];
            foreach ($data as $row) {
                // dd($row);
                $newRow = [];
                foreach ($requiredIndexes as $field => $index) {
                    $newRow[$field] = $row[$index] ?? null;
                }
                $formattedData[] = $newRow;
            }

            $populate = Populate::create([
                'date' => now(),
                'uploaded_by' => Auth::id(),
            ]);

            foreach ($formattedData as $record) {
                // dd($record);
                if (empty(array_filter($record)) || (empty(trim($record['name'])) && empty(trim($record['id_position'])) && empty(trim($record['person_id'])) && empty(trim($record['pers_no'])))) {
                    continue;
                }
                $cleanedRecord = array_map(function ($value, $key) use ($snakeCaseHeader, $formatCode) {
                    $value = trim($value);

                    if ($value === '-' || $value === '') {
                        return null;
                    }

                    $column = $key;

                    // Format jenis kelamin
                    // if ($column == 'jenis_kelamin' && in_array($value, ['M', 'F'])) {
                    //     return $value === "F" ? "Perempuan" : "Laki-laki";
                    // }

                    // Format tanggal
                    $tanggalFields = ['tgl_lahir'];
                    if (in_array($column, $tanggalFields)) {
                        return convDateExcel($value, $formatCode);
                    }

                    $numberOnlyFields = ['id_position', 'pers_no', 'person_id'];
                    if (in_array($column, $numberOnlyFields)) {
                        $cleaned = preg_replace('/\D/', '', $value);
                        return $cleaned !== '' ? (int)$cleaned : null;
                    }

                    return $value;
                }, $record, array_keys($record));

                $recordData = array_combine(array_keys($record), $cleanedRecord);
                $batch_populate = PopulateBatch::create(array_merge(
                    ['populate_id' => $populate->id],
                    $recordData
                ));
            }
            DB::commit();

            return $this->responseSuccess("Data berhasil diunggah.");
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->ResponseError("Terjadi kesalahan: " . $ex->getMessage());
        }
    }

    // public function create(Request $request)
    // {
    //     Log::info("Controller Process");

    //     // Mulai transaction
    //     DB::beginTransaction();
    //     // ini_set('memory_limit', '200M');
    //     try {
    //         // Validasi file Excel
    //         Log::info("Loaded file.");
    //         $request->validate([
    //             'file_attachment' => 'required|file|mimes:xlsx,xls',
    //         ]);

    //         // Baca file Excel
    //         $file = $request->file('file_attachment');
    //         $spreadsheet = IOFactory::load($file->getPathname());

    //         // Ambil sheet "POPULATE Sheet 2"
    //         Log::info("Detect sheet");
    //         // if (empty($request->sheet_name))
    //         $sheetname = $request->sheet_name ?? "Workspace";
    //         $sheet = $spreadsheet->getSheetByName($sheetname);
    //         if (!$sheet) {
    //             throw new Exception("Sheet '{$sheetname}' tidak ditemukan dalam file Excel.");
    //         }
    //         Log::info("Has Detected sheet");

    //         // Konversi sheet ke array
    //         $data = $sheet->toArray();

    //         // Header yang diharapkan
    //         $expectedHeader = [
    //             'Nama', // 0
    //             'Nopek', // 1
    //             'No RM', // 2
    //             'Tempat Lahir', // 3
    //             'Tanggal Lahir', // 4
    //             'Lokasi', // 5
    //             'TahunPOPULATE', // 6
    //             'TglPOPULATE', // 7
    //             'Jenis Kelamin', // 8
    //             'Status Perkawinan', // 9
    //             'Alamat', // 10
    //             'UraianSingkatPekerjaan', // 11
    //             'Hazard/RisikoLingkunganKerja', // 12
    //             'KeluhanUmum', // 13
    //             'Kesadaran', // 14
    //             'Status Mentalis', // 15
    //             'Status Psikologis (SRQ29)', // 16
    //             'KeluhanberhubungandenganPekerjaan', // 17
    //             'RiwayatPenyakitDahulu', // 18
    //             'RiwayatPenyakitKeluarga', // 19
    //             'Riwayat Kecelakaan', // 20
    //             'Riwayat Alergi', // 21
    //             'Riwayat Vaksinasi', // 22
    //             'Riwayat Obs/Gyn', // 23
    //             'Riwayat Operasi', // 24
    //             'Diet', // 25
    //             'Konsumsi Buah/Sayur', // 26
    //             'OlahRaga', // 27
    //             'Merokok', // 28
    //             'Kopi', // 29
    //             'Alkohol', // 30
    //             'ObatRutin', // 31
    //             'TDSistole', // 32
    //             'TDDiastole', // 33
    //             'Nadi', // 34
    //             'Irama Nadi', // 35
    //             'Pernafasan', // 36
    //             'Suhu Badan', // 37
    //             'TB', // 38
    //             'BB', // 39
    //             'LP (Lingkar Pinggang)', // 40
    //             'BMI', // 41
    //             'StatusGizi', // 42
    //             'AVOD', // 43
    //             'AVOS', // 44
    //             'ADD(Koreksi Visus)', // 45
    //             'Tekanan Bola Mata', // 46
    //             'Funduscopy', // 47
    //             'Buta Warna', // 48
    //             'Kepala', // 49
    //             'Leher', // 50
    //             'Mulut', // 51
    //             'Tonsil', // 52
    //             'Pharynx', // 53
    //             'Jantung', // 54
    //             'ParuParu', // 55
    //             'Abdomen', // 56
    //             'Hepar', // 57
    //             'Lien', // 58
    //             'Ginjal', // 59
    //             'Extremitas', // 60
    //             'ReflekFisiologis', // 61
    //             'ReflekPatologis', // 62
    //             'Kulit', // 63
    //             'Haemorhoid', // 64
    //             'Tulang Belakang', // 65
    //             'LainLain', // 66
    //             'Kesimpulan', // 67
    //             'EKG', // 68
    //             'PapSmear', // 69
    //             'TreadmillTest', // 70
    //             'StatusKebugaran', // 71
    //             'TargetNadiOlahraga', // 72
    //             'Test Rockport', // 73
    //             'Napfa', // 74
    //             'Spirometri', // 75
    //             'Audiometri', // 76
    //             'Mammografi', // 77
    //             'USGAbdomen', // 78
    //             'BiologicalMonitoring', // 79
    //             'ToraksFoto', // 80
    //             'Mata', // 81
    //             'THT', // 82
    //             'D', // 83
    //             'M', // 84
    //             'F', // 85
    //             'AdviceGimul', // 86
    //             'HB', // 87
    //             'Leukosit', // 88
    //             'Eritrosit', // 89
    //             'Hematokrit', // 90
    //             'Trombosit', // 91
    //             'LED', // 92
    //             'Basofil', // 93
    //             'Eosinofil', // 94
    //             'Batang', // 95
    //             'Segmen', // 96
    //             'Limfosit', // 97
    //             'Monosit', // 98
    //             'HapusanDarah', // 99
    //             'WarnaUrine', // 100
    //             'Berat Jenis', // 101
    //             'PH Urine', // 102
    //             'Protein', // 103
    //             'Nitrit', // 104
    //             'ReduksiN', // 105
    //             'ReduksiPP', // 106
    //             'Aseton Urin', // 107
    //             'Bilirubin', // 108
    //             'Urobilinogen', // 109
    //             'Leukosit Esterase', // 110
    //             'SelEpithel', // 111
    //             'LeukositUrine', // 112
    //             'EritrositUrine', // 113
    //             'Silinder', // 114
    //             'Bakteri', // 115
    //             'Jamur', // 116
    //             'Kristal', // 117
    //             'Konsistensi', // 118
    //             'WarnaFaeces', // 119
    //             'Lendir', // 120
    //             'DarahNanah', // 121
    //             'EritrositFaeces', // 122
    //             'LeukositFaeces', // 123
    //             'AmubaProtozoa', // 124
    //             'Kista', // 125
    //             'SisaPencernaan', // 126
    //             'TelorCacing', // 127
    //             'Kultur Faeces', // 128
    //             'GulaDarahPuasa', // 129
    //             'GulaDarah2jamPP', // 130
    //             'Hba1c', // 131
    //             'KolesterolTotal', // 132
    //             'Trigliserida', // 133
    //             'HDL', // 134
    //             'LDL', // 135
    //             'Rasio TC/HDL', // 136
    //             'Ureum', // 137
    //             'Kreatinin', // 138
    //             'AsamUrat', // 139
    //             'SGOT', // 140
    //             'SGPT', // 141
    //             'BillTotal', // 142
    //             'Bili Direct', // 143
    //             'Bili Indirect', // 144
    //             'ALKFospat', // 145
    //             'Kolinesterase', // 146
    //             'HbsAg', // 147
    //             'Anti HBs', // 148
    //             'HBeAg', // 149
    //             'Anti HCV', // 150
    //             'TPHA', // 151
    //             'VDRL', // 152
    //             'BTA Sputum', // 153
    //             'Drug Test', // 154
    //             'Alcohol Test', // 155
    //             'KesimpulanDerajatKesehatan', // 156
    //             'KesimpulanKelaikanKerja', // 157
    //             'Risiko Cardiovascular (SKJ)', // 158
    //             'Risiko Cardiovascular (SF)', // 159
    //             'SaranDokter', // 160
    //             'Rekomendasi', // 161
    //             'Dokter', // 162
    //             'AnamnesaMata', // 163
    //             'Penglihatan', // 164
    //             'TestIshihara', // 165
    //             'KesimpulanMata', // 166
    //             'SaranMata', // 167
    //             'AnamnesaTHT', // 168
    //             'Telinga', // 169
    //             'Hidung', // 170
    //             'Tenggorokan', // 171
    //             'KesimpulanTHT', // 172
    //             'SaranTHT', // 173
    //             'TanggalSelesai', // 174
    //             'Kesimpulan1', // 175
    //             'Kesimpulan2', // 176
    //             'Kesimpulan3', // 177
    //             'Nasehat1', // 178
    //             'Nasehat2', // 179
    //             'Diet1', // 180
    //             'Diet2', // 181
    //             'Diet3', // 182
    //             'NasehatLain', // 183
    //             'Saran1', // 184
    //             'Saran2', // 185
    //             'Saran3', // 186
    //         ];

    //         // Validasi header Excel

    //         $header = $data[0]; // Baris pertama adalah header
    //         dd($header);
    //         if ($header !== $expectedHeader) {
    //             throw new Exception("Format Excel tidak valid. Pastikan header sesuai dengan urutan yang diharapkan.");
    //         }

    //         // Hapus header dari data
    //         array_shift($data);

    //         // Simpan data ke tabel populate
    //         $populate = Populate::create([
    //             'date' => now(), // Tanggal upload
    //             'uploaded_by' => Auth::id(), // ID pengguna yang mengunggah
    //         ]);

    //         // Proses setiap baris data
    //         foreach ($data as $record) {
    //             // Pastikan data tidak kosong
    //             if (empty(array_filter($record))) {
    //                 continue;
    //             }

    //             // Simpan data ke tabel populate_batch
    //             PopulateBatch::create([
    //                 'populate_id' => $populate->id,
    //                 'nomor_pekerja' => $record[1], // Index sesuai urutan header
    //                 'jenis_kelamin' => $record[2],
    //                 'tempat_lahir' => $record[3],
    //                 'tanggal_lahir' => $record[4],
    //                 'no_rekam_medis' => $record[5],
    //                 'lokasi_pekerja' => $record[6],
    //                 'fungsi' => $record[7],
    //                 'potensi_hazard' => $record[8],
    //                 'lokasi_populate' => $record[9],
    //                 'tanggal_mulai_populate' => $record[10],
    //                 'tanggal_selesai_populate' => $record[11],
    //             ]);
    //         }

    //         // Commit transaction jika semua operasi berhasil
    //         DB::commit();

    //         // Ambil data POPULATE beserta batch-nya untuk response
    //         $populate->load('batches');

    //         return $this->responseSuccess($populate);
    //     } catch (SpreadsheetException $ex) {
    //         // Rollback transaction jika terjadi kesalahan terkait file Excel
    //         DB::rollBack();
    //         return $this->ResponseError("Terjadi kesalahan saat membaca file Excel: " . $ex->getMessage());
    //     } catch (Exception $ex) {
    //         // Rollback transaction jika terjadi kesalahan umum
    //         DB::rollBack();
    //         return $this->ResponseError($ex->getMessage());
    //     }
    // }

    public function createCSV(Request $request)
    {
        // Mulai transaction
        DB::beginTransaction();

        try {
            // Validasi file CSV
            $request->validate([
                'file_attachment' => 'required|file|mimes:csv,txt',
            ]);

            // Baca file CSV
            $file = $request->file('file_attachment');
            $csv = Reader::createFromPath($file->getPathname(), 'r');
            $csv->setHeaderOffset(0); // Set baris pertama sebagai header

            // Header yang diharapkan
            $expectedHeader = [
                'Nama Pekerja',
                'Nomor Pekerja',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'No Rekam Medis',
                'Lokasi Pekerja',
                'Fungsi',
                'Potensi Hazard',
                'Lokasi POPULATE',
                'Tanggal Mulai POPULATE',
                'Tanggal Selesai POPULATE',
            ];

            // Validasi header CSV
            $header = $csv->getHeader();
            if ($header !== $expectedHeader) {
                throw new Exception("Format CSV tidak valid. Pastikan header sesuai dengan urutan yang diharapkan.");
            }

            // Simpan data ke tabel populate
            $populate = Populate::create([
                'date' => now(), // Tanggal upload
                'uploaded_by' => Auth::id(), // ID pengguna yang mengunggah
            ]);

            // Proses setiap baris CSV
            foreach ($csv as $record) {
                // Pastikan data tidak kosong
                if (empty(array_filter($record))) {
                    continue;
                }

                // Simpan data ke tabel populate_batch
                PopulateBatch::create([
                    'populate_id' => $populate->id,
                    'nomor_pekerja' => $record['Nomor Pekerja'],
                    'jenis_kelamin' => $record['Jenis Kelamin'],
                    'tempat_lahir' => $record['Tempat Lahir'],
                    'tanggal_lahir' => $record['Tanggal Lahir'],
                    'no_rekam_medis' => $record['No Rekam Medis'],
                    'lokasi_pekerja' => $record['Lokasi Pekerja'],
                    'fungsi' => $record['Fungsi'],
                    'potensi_hazard' => $record['Potensi Hazard'],
                    'lokasi_populate' => $record['Lokasi POPULATE'],
                    'tanggal_mulai_populate' => $record['Tanggal Mulai POPULATE'],
                    'tanggal_selesai_populate' => $record['Tanggal Selesai POPULATE'],
                ]);
            }

            // Commit transaction jika semua operasi berhasil
            DB::commit();

            // Ambil data POPULATE beserta batch-nya untuk response
            $populate->load('batches');

            return $this->responseSuccess($populate);
        } catch (Exception $ex) {
            // Rollback transaction jika terjadi kesalahan
            DB::rollBack();

            return $this->ResponseError($ex->getMessage());
        }
    }


    public function show(string $slug)
    {
        try {
            $query =  Populate::with(['ref_populate', 'owner']);
            $query->where('slug', '=', $slug);
            $res = $query->get()->first();
            return view('page.populate.show', ['dataContent' => $res]);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        try {
            $data = Populate::with(['ref_populate', 'owner'])->findOrFail($request->id);
            $att = [
                'description' => $request->description,
                'doc_date' => $request->doc_date,
                'ref_populate_id' => $request->ref_populate_id,
                'upload_by' => Auth::user()->id,
                'user_id' => $request->user_id,


            ];
            if ($request->description != $data->description)
                $att['slug'] = Populate::createUniqueSlug($request->description, $request->id);

            if ($request->hasFile('file_attachment')) {
                $photo = $request->file('file_attachment');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/populate', $originalFilename, 'public');
                // dd($path);
                $att['filename']  = $originalFilename;
            }
            $data->update($att);
            $data = Populate::with(['ref_populate', 'owner'])->findOrFail($request->id);
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Populate::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
