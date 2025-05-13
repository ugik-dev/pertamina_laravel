<?php

namespace App\Http\Controllers;

use App\Models\Mcu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade untuk transaction
use Illuminate\Support\Facades\Validator;
use App\Helpers\DataStructure;
use App\Models\McuBatch;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as SpreadsheetException;


class MCUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refUser' => User::select('id', 'name')->get(),
        ];
        return view('page.mcu.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  Mcu::with(['uploadedBy'])->withCount('batches');
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
            'paramMCU' => getParamMCU()
        ];
        return view('page.mcu.detail', compact('request', 'dataContent'));
    }

    public function fetch_detail(Request $request, int $id)
    {
        try {
            $query =  Mcu::with(['uploadedBy', 'batches'])->withCount('batches');
            $query->where('id', '=', $id);
            $res = $query->first();

            $batch = McuBatch::where('mcu_id', '=', $id)->get();
            $statis['gender'] = [
                'Laki-laki' => $batch->where('jenis_kelamin', 'Laki-laki')->count(),
                'Perempuan' => $batch->where('jenis_kelamin', 'Perempuan')->count(),
            ];

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
                $tanggalLahir = $peserta->tanggal_lahir; // Ambil tanggal lahir
                $usia = Carbon::parse($tanggalLahir)->age; // Hitung usia

                foreach ($rentangUsia as $label => $range) {
                    if ($usia >= $range[0] && $usia <= $range[1]) {
                        $chartByUsia[$label]++;
                        break;
                    }
                }
            }
            // Grouping by lokasi
            $batch->transform(function ($item) {
                $item->lokasi = str_replace(['Laboratorium', ','], ['Lab', ''], $item->lokasi);
                return $item;
            });
            $lokasiData = $batch->groupBy('lokasi')->map->count();
            $byLokasi['data'] = $batch->groupBy('lokasi')->map->count()->sortByDesc(function ($count) {
                return $count;
            });;
            $byLokasi['categories'] = $lokasiData->keys()->toArray(); // Nama-nama lokasi
            $byLokasi['values'] = $lokasiData->values()->toArray();

            $jenisKesimpulan = ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'];
            $kesimpulan1 = $batch->groupBy('kesimpulan1')->map->count();
            $kesimpulan2 = $batch->groupBy('kesimpulan2')->map->count();
            // $kardio['Rendah'] = $batch->where('risiko_cardiovascular_skj', 'Rendah')->count();
            // $kardio['Sedang'] = $batch->where('risiko_cardiovascular_skj', 'Sedang')->count();
            // $kardio['Tinggi'] = $batch->where('risiko_cardiovascular_skj', 'Tinggi')->count();
            // $kardio['Lainnya'] = $batch->whereNotIn('risiko_cardiovascular_skj', ['Rendah', 'Sedang', 'Tinggi'])->count();
            // $ekg['Abnormal'] = $batch->where('ekg', 'Abnormal')->count();
            // $ekg['Normal'] = $batch->where('ekg', 'Normal')->count();
            // $ekg['Blok Jantung'] = $batch->where('ekg', 'Blok Jantung')->count();
            // $ekg['Lainnya'] = $batch->whereNotIn('ekg', ['Abnormal', 'Normal', 'Blok Jantung'])->count();

            $merokok = [
                'Ya' => $batch->filter(function ($item) {
                    return stripos($item->merokok, 'ya') !== false;
                })->count(),

                'Tidak' => $batch->filter(function ($item) {
                    return stripos($item->merokok, 'ya') === false;
                })->count(),
            ];
            $kardio = $this->pluckField($batch, 'risiko_cardiovascular_skj');
            $ekg = $this->pluckField($batch, 'ekg');
            $bmi = $this->pluckField($batch, 'status_gizi');
            // dd($bmi);
            $dataKesimpulan1 = [];
            $dataKesimpulan2 = [];

            foreach ($jenisKesimpulan as $jenis) {
                $dataKesimpulan1[] = $kesimpulan1[$jenis] ?? 0; // Jika tidak ada data, isi dengan 0
                $dataKesimpulan2[] = $kesimpulan2[$jenis] ?? 0; // Jika tidak ada data, isi dengan 0
            }

            $chartKesimpulan = [
                'jenis_kesimpulan' => $jenisKesimpulan, // Kategori (P1, P2, dst.)
                'values' => [
                    'kesimpulan1' => $dataKesimpulan1, // Data untuk kesimpulan1
                    'kesimpulan2' => $dataKesimpulan2, // Data untuk kesimpulan2
                ],
            ];

            $statis['kesimpulan'] = $chartKesimpulan;
            $statis['usia'] = $chartByUsia;
            $statis['lokasi'] = $byLokasi;
            $statis['kardio'] = $kardio;
            $statis['ekg'] = $ekg;
            $statis['bmi'] = $bmi;
            $statis['merokok'] = $merokok;
            $res['statis'] = $statis;
            return $this->responseSuccess($res);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
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



    function convertDate($dateString)
    {
        // Cek apakah kosong
        if (empty($dateString)) {
            return null;
        }

        // Ubah dari format d/m/Y ke Y-m-d
        $date = \DateTime::createFromFormat('d/m/Y', $dateString);
        if ($date) {
            return $date->format('Y-m-d');
        }

        // Tambahan: jika formatnya m/d/Y (untuk file yang pakai format US)
        $date = \DateTime::createFromFormat('m/d/Y', $dateString);
        if ($date) {
            return $date->format('Y-m-d');
        }

        // Kalau tetap gagal parsing, bisa return null atau original string (tapi ini berbahaya)
        return null;
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

            // Ambil sheet "MCU Sheet 2"
            $sheet = $spreadsheet->getSheetByName($request->sheet_name ?? "Sheet1");
            // dd($sheet);
            if (!$sheet) {
                throw new Exception("Sheet tidak ditemukan dalam file Excel.");
            }

            // Konversi sheet ke array
            $data = $sheet->toArray();

            // Ambil header dari baris pertama
            $header = array_shift($data);

            // Ubah header ke snake_case
            $headerMcu = getHeaderMCU();
            foreach ($headerMcu as $key => $hm) {
                if (trim($hm) != trim($header[$key])) {
                    throw new Exception('Header terjadi kesalahan, harap kanti ' . $header[$key] . ' menjadi ' . $hm);
                }
            }
            // dd($header);
            $snakeCaseHeader = array_map('toSnakeCase', $header);
            $mcu = Mcu::create([
                'date' => now(), // Tanggal upload
                'uploaded_by' => Auth::id(), // ID pengguna yang mengunggah
            ]);

            foreach ($data as $record) {
                if (empty(array_filter($record))) {
                    continue;
                }

                // $recordData = array_combine($snakeCaseHeader, $record);
                $cleanedRecord = array_map(function ($value, $key) use ($snakeCaseHeader) {
                    // Ganti '-' atau ' -' atau '-' dengan null
                    if (trim($value) === '-' || trim($value) === '') {
                        return null;
                    }

                    if ($snakeCaseHeader[$key] == 'jenis_kelamin' && in_array($value, ['M', 'F'])) {
                        return $value == "F" ? "Perempuan" : ($value == "M" ? "Laki-laki" : null);
                    }
                    // Format kolom tanggal
                    $tanggalFields = ['tanggal_lahir', 'tanggal_selesai', 'tanggal_mcu', 'tanggal_selesai'];
                    if (in_array($snakeCaseHeader[$key], $tanggalFields)) {
                        $date = \DateTime::createFromFormat('d/m/Y', trim($value));
                        if ($date) {
                            return $date->format('Y-m-d');
                        }
                        return null;
                    }

                    return trim($value);
                }, $record, array_keys($record));
                $recordData = array_combine($snakeCaseHeader, $cleanedRecord);
                // dd($recordData);

                McuBatch::create(array_merge(
                    ['mcu_id' => $mcu->id],
                    $recordData
                ));
            }

            // Commit transaction
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

    //         // Ambil sheet "MCU Sheet 2"
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
    //             'TahunMCU', // 6
    //             'TglMCU', // 7
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

    //         // Simpan data ke tabel mcu
    //         $mcu = Mcu::create([
    //             'date' => now(), // Tanggal upload
    //             'uploaded_by' => Auth::id(), // ID pengguna yang mengunggah
    //         ]);

    //         // Proses setiap baris data
    //         foreach ($data as $record) {
    //             // Pastikan data tidak kosong
    //             if (empty(array_filter($record))) {
    //                 continue;
    //             }

    //             // Simpan data ke tabel mcu_batch
    //             McuBatch::create([
    //                 'mcu_id' => $mcu->id,
    //                 'nomor_pekerja' => $record[1], // Index sesuai urutan header
    //                 'jenis_kelamin' => $record[2],
    //                 'tempat_lahir' => $record[3],
    //                 'tanggal_lahir' => $record[4],
    //                 'no_rekam_medis' => $record[5],
    //                 'lokasi_pekerja' => $record[6],
    //                 'fungsi' => $record[7],
    //                 'potensi_hazard' => $record[8],
    //                 'lokasi_mcu' => $record[9],
    //                 'tanggal_mulai_mcu' => $record[10],
    //                 'tanggal_selesai_mcu' => $record[11],
    //             ]);
    //         }

    //         // Commit transaction jika semua operasi berhasil
    //         DB::commit();

    //         // Ambil data MCU beserta batch-nya untuk response
    //         $mcu->load('batches');

    //         return $this->responseSuccess($mcu);
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
                'Lokasi MCU',
                'Tanggal Mulai MCU',
                'Tanggal Selesai MCU',
            ];

            // Validasi header CSV
            $header = $csv->getHeader();
            if ($header !== $expectedHeader) {
                throw new Exception("Format CSV tidak valid. Pastikan header sesuai dengan urutan yang diharapkan.");
            }

            // Simpan data ke tabel mcu
            $mcu = Mcu::create([
                'date' => now(), // Tanggal upload
                'uploaded_by' => Auth::id(), // ID pengguna yang mengunggah
            ]);

            // Proses setiap baris CSV
            foreach ($csv as $record) {
                // Pastikan data tidak kosong
                if (empty(array_filter($record))) {
                    continue;
                }

                // Simpan data ke tabel mcu_batch
                McuBatch::create([
                    'mcu_id' => $mcu->id,
                    'nomor_pekerja' => $record['Nomor Pekerja'],
                    'jenis_kelamin' => $record['Jenis Kelamin'],
                    'tempat_lahir' => $record['Tempat Lahir'],
                    'tanggal_lahir' => $record['Tanggal Lahir'],
                    'no_rekam_medis' => $record['No Rekam Medis'],
                    'lokasi_pekerja' => $record['Lokasi Pekerja'],
                    'fungsi' => $record['Fungsi'],
                    'potensi_hazard' => $record['Potensi Hazard'],
                    'lokasi_mcu' => $record['Lokasi MCU'],
                    'tanggal_mulai_mcu' => $record['Tanggal Mulai MCU'],
                    'tanggal_selesai_mcu' => $record['Tanggal Selesai MCU'],
                ]);
            }

            // Commit transaction jika semua operasi berhasil
            DB::commit();

            // Ambil data MCU beserta batch-nya untuk response
            $mcu->load('batches');

            return $this->responseSuccess($mcu);
        } catch (Exception $ex) {
            // Rollback transaction jika terjadi kesalahan
            DB::rollBack();

            return $this->ResponseError($ex->getMessage());
        }
    }


    public function show(string $slug)
    {
        try {
            $query =  Mcu::with(['ref_mcu', 'owner']);
            $query->where('slug', '=', $slug);
            $res = $query->get()->first();
            return view('page.mcu.show', ['dataContent' => $res]);
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
            $data = Mcu::with(['ref_mcu', 'owner'])->findOrFail($request->id);
            $att = [
                'description' => $request->description,
                'doc_date' => $request->doc_date,
                'ref_mcu_id' => $request->ref_mcu_id,
                'upload_by' => Auth::user()->id,
                'user_id' => $request->user_id,


            ];
            if ($request->description != $data->description)
                $att['slug'] = Mcu::createUniqueSlug($request->description, $request->id);

            if ($request->hasFile('file_attachment')) {
                $photo = $request->file('file_attachment');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/mcu', $originalFilename, 'public');
                // dd($path);
                $att['filename']  = $originalFilename;
            }
            $data->update($att);
            $data = Mcu::with(['ref_mcu', 'owner'])->findOrFail($request->id);
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Mcu::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
