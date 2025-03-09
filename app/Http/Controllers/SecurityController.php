<?php

namespace App\Http\Controllers;

use App\Exports\ExportDCU;
use App\Helpers\Helpers;
use App\Models\Attendance;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class SecurityController extends Controller
{

    public function healty(Request $request)
    {
        try {
            DB::connection()->getPdo();
            $dbStatus = 'Database connection: OK';
        } catch (\Exception $e) {
            $dbStatus = 'Database connection: Failed';
        }

        // Cek cache
        try {
            Cache::put('health_check_cache', 'ok', 1);
            $cacheStatus = 'Cache: OK';
        } catch (\Exception $e) {
            $cacheStatus = 'Cache: Failed';
        }

        // Cek file system (Optional: untuk memastikan direktori writeable)
        $fileStatus = is_writable(storage_path('logs')) ? 'File system: OK' : 'File system: Failed';

        // Cek API status (Contoh jika menggunakan service eksternal)
        // Misalnya, Anda bisa cek API eksternal atau service lainnya
        $apiStatus = 'API: OK';  // Gantilah ini jika perlu pengecekan eksternal

        return response()->json([
            'status' => 'healthy',
            'db_status' => $dbStatus,
            'cache_status' => $cacheStatus,
            'file_status' => $fileStatus,
            'api_status' => $apiStatus,
            'timestamp' => now()->toDateTimeString(),
        ], Response::HTTP_OK);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $date = $request->input('filter.screening_date')
                ? Carbon::parse($request->input('filter.screening_date'))->format('Y-m-d')
                : Carbon::today()->format('Y-m-d');

            // Query untuk mengambil data attendance
            // $query = DB::table('users as a') // Mulai dari tabel users
            //     ->selectRaw('attendances.*, a.name as user_name,
            //              att.checkin_time, att.checkout_time')
            //     ->leftJoin('attendances as att', 'a.id', '=', 'att.user_id') // Gabungkan dengan tabel attendances
            //     ->whereDate('att.checkin_time', $date); // Filter hanya untuk hari ini
            // dd($query->toSql());
            // Eksekusi query untuk mendapatkan data
            // if (!empty($status)) {
            //     if ($status == 'fit') {
            //         $query->where("fitality", "=", "Y");
            //     } else if ($status == 'unfit') {
            //         $query->where("fitality", "=", "N");
            //     } else if ($status == 'hasScreening') {
            //         $query->whereNotNull("screenings.id");
            //     } elseif ($status == 'notScreening') {
            //         $query->whereNull("screenings.id");
            //     }
            // }
            // ->whereDate('screenings.created_at', "2024-09-06")
            // ->latest()->get();
            // ->get();
            // $query = Attendance::whereDate('checkin_time', $date);
            $query = DB::table('users as a') // Mulai dari tabel users
                ->selectRaw('attendances.*,c.name as company_name,c.category as company_category,a.pola, a.name as user_name, a.qrcode as user_qrcode, f.high_risk')
                ->leftJoin('attendances', function ($join) use ($date) {
                    $join->on('attendances.user_id', '=', 'a.id')
                        ->whereDate('attendances.created_at', $date);
                })
                ->leftJoin('field_works as f', 'a.field_work_id', '=', 'f.id')
                ->leftJoin('companies as c', 'a.company_id', '=', 'c.id');
            // ->leftJoin('users as b', 'b.id', '=', 'screenings.doctor_id');

            $data = $query->get();
            // dd($data);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('span_checkin_time', function ($data) {
                    return $data->checkin_time ? Carbon::parse($data->checkin_time)->format('H:i') : '-';
                })
                ->addColumn('span_checkout_time', function ($data) {
                    return $data->checkout_time ? Carbon::parse($data->checkout_time)->format('H:i') : '-';
                })
                ->addColumn('working_duration', function ($data) {
                    // Jika pegawai sudah checkout, hitung durasi kerja
                    if ($data->checkout_time) {
                        $checkinTime = Carbon::parse($data->checkin_time);
                        $checkoutTime = Carbon::parse($data->checkout_time);
                        $duration = $checkinTime->diff($checkoutTime);
                        return $duration->format('%h jam %i menit');
                    } else {
                        // Jika belum checkout, tampilkan "-"
                        return "-";
                    }
                })
                ->addColumn('aksi', function ($data) {
                    // Tombol untuk aksi edit
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })
                ->addColumn('dcu', function ($data) {
                    // Tombol untuk aksi edit
                    return '<button data-id="' . $data->dcu_id . '" class="editBtn btn btn-primary"><i class="mdi mdi-eye-outline"></i></button>';
                })
                ->rawColumns(['aksi', 'dcu', 'working_duration'])
                ->make(true);
        }

        return view('page.security.index', compact('request'));
    }

    public function scanner(Request $request)
    {
        return view('page.screening.scanner');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function checkin_gate($code)
    {
        try {
            // Cari user berdasarkan qrcode
            $user = User::select('id', 'name', 'qrcode', 'empoyee_id')->where('qrcode', $code)->firstOrFail();

            $latestScreening = Screening::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();




            // Jika tidak ada screening hari ini, kembalikan respon error
            // dd($latestScreening);
            if (!$latestScreening) {
                return $this->ResponseError("Maaf {$user['name']}, anda belum screening hari ini!", 400, $user);
            } else if ($latestScreening->fitality != 'Y') {
                return $this->ResponseError("Maaf {$user['name']}, anda dalam kondisi tidak fit!", 400, $user);
            }

            // Cek apakah user sudah check-in hari ini
            // $attendance = Attendance::where('user_id', $user->id)
            //     ->whereDate('checkin_time', Carbon::today())
            //     ->first();
            $attendance = Attendance::where('user_id', $user->id)
                ->whereNull('checkout_time') // Hanya cek yang belum checkout
                ->whereDate('checkin_time', '<=', Carbon::today()) // Memperbolehkan check-in pada hari sebelumnya
                ->first();


            if ($attendance) {
                // Jika sudah check-in, tapi belum checkout
                if (!$attendance->checkout_time) {
                    return $this->ResponseError("Maaf {$user['name']}, anda sudah melakukan check-in hari ini, tetapi belum melakukan checkout.");
                }

                // Jika sudah check-in dan checkout
                return $this->ResponseError("Maaf {$user['name']}, anda sudah melakukan check-in dan checkout hari ini.");
            }

            // Jika belum ada check-in hari ini, buat record baru
            $attendance = Attendance::create([
                'user_id' => $user->id,
                'dcu_id' => $latestScreening->id,
                'checkin_time' => Carbon::now(),
                'status' => 'checked in',
                'qrcode' => $code,
            ]);

            return $this->responseSuccess($attendance, 'Check-in berhasil',);
        } catch (ModelNotFoundException $ex) {
            return $this->ResponseError("Data tidak ditemukan!!", 400);
        } catch (\Exception $ex) {
            return $this->ResponseError($ex->getMessage(), 500);
        }
    }

    public function checkin($code)
    {
        try {
            // Cari user berdasarkan qrcode
            $user = User::select('id', 'name', 'qrcode', 'empoyee_id')->where('qrcode', $code)->firstOrFail();

            $latestScreening = Screening::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();




            // Jika tidak ada screening hari ini, kembalikan respon error
            // dd($latestScreening);
            if (!$latestScreening) {
                return $this->ResponseError("Maaf {$user['name']}, anda belum screening hari ini!", 400, $user);
            } else if ($latestScreening->fitality != 'Y') {
                return $this->ResponseError("Maaf {$user['name']}, anda dalam kondisi tidak fit!", 400, $user);
            }

            // Cek apakah user sudah check-in hari ini
            // $attendance = Attendance::where('user_id', $user->id)
            //     ->whereDate('checkin_time', Carbon::today())
            //     ->first();
            $attendance = Attendance::where('user_id', $user->id)
                ->whereNull('checkout_time') // Hanya cek yang belum checkout
                ->whereDate('checkin_time', '<=', Carbon::today()) // Memperbolehkan check-in pada hari sebelumnya
                ->first();


            if ($attendance) {
                // Jika sudah check-in, tapi belum checkout
                if (!$attendance->checkout_time) {
                    return $this->ResponseError("Maaf {$user['name']}, anda sudah melakukan check-in hari ini, tetapi belum melakukan checkout.");
                }

                // Jika sudah check-in dan checkout
                return $this->ResponseError("Maaf {$user['name']}, anda sudah melakukan check-in dan checkout hari ini.");
            }

            // Jika belum ada check-in hari ini, buat record baru
            $attendance = Attendance::create([
                'user_id' => $user->id,
                'in_security_id' => auth()->user()->id, // Misalnya, ID security yang sedang memverifikasi
                'checkin_time' => Carbon::now(),
                'status' => 'checked in',
                'qrcode' => $code,
            ]);

            return $this->responseSuccess($attendance, 'Check-in berhasil',);
        } catch (ModelNotFoundException $ex) {
            return $this->ResponseError("Data tidak ditemukan!!", 400);
        } catch (\Exception $ex) {
            return $this->ResponseError($ex->getMessage(), 500);
        }
    }

    /**
     * Handle the check-out process.
     */
    public function checkout($code)
    {
        try {
            // Cari user berdasarkan qrcode
            $user = User::where('qrcode', $code)->firstOrFail();

            // Cek apakah user sudah check-in hari ini
            $attendance = Attendance::where('user_id', $user->id)
                ->whereNull('checkout_time') // Hanya cek yang belum checkout
                ->whereDate('checkin_time', '<=', Carbon::today()) // Memperbolehkan checkout hari ini, meskipun check-in sebelumnya
                ->first();


            if (!$attendance) {
                return $this->ResponseError('Anda belum melakukan check-in hari ini.');
            }

            // Cek apakah user sudah melakukan check-out
            if ($attendance->checkout_time) {
                return $this->ResponseError('Anda sudah melakukan check-out hari ini.');
            }

            // Update waktu checkout
            $attendance->update([
                'checkout_time' => Carbon::now(),
                'out_security_id' => auth()->user()->id, // ID security yang memverifikasi checkout
            ]);

            return $this->responseSuccess('Check-out berhasil', $attendance);
        } catch (Exception $ex) {
            return $this->ResponseError($ex->getMessage());
        }
    }
    public function scanner_process($code)
    {
        try {
            // Cari user dengan qrcode yang valid
            $user = User::where('qrcode', $code)->firstOrFail();
            // dd(Carbon::today());
            // Ambil screening terbaru hari ini
            $latestScreening = Screening::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();




            // Jika tidak ada screening hari ini, kembalikan respon error
            if (!$latestScreening) {
                return $this->ResponseError("Belum ada screening hari ini");
            }
            $user['screening'] = $latestScreening;
            // Kembalikan respon sukses dengan data screening terbaru
            return $this->responseSuccess($user);
        } catch (Exception $ex) {
            // Tangani exception jika ada
            return $this->ResponseError($ex->getMessage());
        }
    }

    function getResult($req)
    {
        // dd((!isset($req['alcohol']) || Helpers::spanAlcoholTest($req['alcohol'], true)));
        if (
            Helpers::spanSistole($req['sistole'], true) &&
            Helpers::spanDiastole($req['diastole'], true) &&
            Helpers::spanHr($req['hr'], true) &&
            Helpers::spanTemp($req['temp'], true) &&
            Helpers::spanRr($req['rr'], true)
            && (!isset($req['spo2']) || Helpers::spanSpo2($req['spo2'], true))
            && (!isset($req['romberg']) || Helpers::spanRomberg($req['romberg'], true))
            && (!isset($req['alcohol']) || Helpers::spanAlcoholTest($req['alcohol'], true))
        ) {
            return 'Y';
        } else {
            return 'N';
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export(Request $request)
    {
        $filter = $request->query(); // atau $request->all()
        $filter['date_start']  = $filter['date_start']  . ' 00:00:00';
        $filter['date_end']  = $filter['date_end']  . ' 23:59:59';
        // Atau ambil parameter tertentu
        // $date_start = null;
        // $date_end = null;
        // if (isset($param['name'])) {
        //     if ($param['name'] === 'date_start') {
        //         $date_start = $param['value'];
        //     } elseif ($param['name'] === 'date_end') {
        //         $date_end = $param['value'];
        //     }
        // }
        // dd($date_end, $date_start);
        $filename = "dcu-rekap-" . $filter['date_start'] . '-sd-' . $filter['date_end'];
        $query =  Screening::selectRaw('screenings.*, a.name as user_name,a.qrcode as user_qrcode, b.name doctor_name')
            ->join('users as a', 'a.id', '=', 'screenings.user_id')
            ->join('users as b', 'b.id', '=', 'screenings.doctor_id')->orderBy("screenings.created_at", "asc");
        if ($filter['date_start'] == $filter['date_end']) {
            $data = $query->whereDate('screenings.created_at', $filter['date_start'])->latest()->get();
        } else {
            $data = $query->whereBetween('screenings.created_at', [$filter['date_start'], $filter['date_end']])->latest()->get();
        }
        // $data = $query->get();
        // dd($data);
        return Excel::download(new ExportDCU($data, $filter),  $filename . '.xlsx');
    }
}
