<?php

namespace App\Http\Controllers;

use App\Exports\ExportSebuse;
use App\Exports\ExportWorkout;
use App\Helpers\Helpers;
use App\Models\Form;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\Workout;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class WorkoutController extends Controller
{
    public function pengguna(Request $request)
    {
        if ($request->ajax()) {
            $data =  LoginSession::latest()->get();
            return DataTables::of($data)->addColumn('id', function ($data) {
                return $data->id;
            })->addColumn('created_at', function ($data) {
                return $data->created_at;
            })->addColumn('name', function ($data) {
                return $data->name;
            })->addColumn('phone', function ($data) {
                return $data->phone;
            })->addColumn('aksi', function ($data) {
                return "AKSI";
            })->make(true);
        }
        return view('page.pengguna', compact('request'));
    }
    public function getData(Request $request)
    {
        $data =  RequestCall::selectRaw('request_calls.*, login_session.name, login_session.phone, ref_emergencies.name as workout_name')
            ->join('login_session', 'login_session.id', '=', 'request_calls.login_session_id')
            ->join('ref_emergencies', 'ref_emergencies.id', '=', 'request_calls.ref_workout_id')
            ->where('request_calls.id', '=', $request->id_request)
            ->get()->first();

        return $this->responseSuccess(['success', 'data' => $data]);
    }

    public function detail($id, Request $request)
    {
        $data = RequestCall::with(['login_session', 'ref_workout', 'logs.user', 'forms', 'forms.user'])
            ->findOrFail($id);
        // dd($data);
        $dataContent = $data;
        return view('page.workout.detail', compact('dataContent'));
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  Workout::selectRaw('workouts.*, a.name as user_name,a.qrcode as user_qrcode, b.name doctor_name, f.high_risk')
                ->join('users as a', 'a.id', '=', 'workouts.user_id')
                ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
                ->join('users as b', 'b.id', '=', 'workouts.doctor_id')
                ->whereDate('workouts.created_at', Carbon::today())
                // ->whereDate('workouts.created_at', "2024-09-06")
                // ->latest()->get();
                ->limit(100)->get();
            // dd($data);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('timescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('H:i');
                })->addColumn('sistole_span', function ($data) {
                    return Helpers::spanSistole($data->sistole);
                })->addColumn('diastole_span', function ($data) {
                    return Helpers::spanDiastole($data->diastole);
                })->addColumn('hr_span', function ($data) {
                    return Helpers::spanHr($data->hr);
                })->addColumn('rr_span', function ($data) {
                    return Helpers::spanRr($data->rr);
                })->addColumn('temp_span', function ($data) {
                    return Helpers::spanTemp($data->temp);
                })->addColumn('spo2_span', function ($data) {
                    return Helpers::spanSpo2($data->spo2);
                })->addColumn('romberg_span', function ($data) {
                    return Helpers::spanRomberg($data->romberg);
                })->addColumn('alcohol_span', function ($data) {
                    return Helpers::spanAlcoholTest($data->alcohol);
                })->addColumn('result_span', function ($data) {
                    return $data->fitality == 'Y' ? "<span class='text-success'>FIT</span>" : "<span class='text-danger'>UNFIT</span>";
                })->addColumn('high_risk_span', function ($data) {
                    return Helpers::spanRisk($data->high_risk);
                })->addColumn('aksi', function ($data) {
                    // return '<a href="' . route('detail-workout', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns(['aksi', 'high_risk_span', 'sistole_span', 'diastole_span', 'hr_span', 'rr_span', 'spo2_span', 'temp_span', 'result_span', 'romberg_span', 'alcohol_span'])->make(true);
        }
        return view('page.workout.index', compact('request'));
    }

    public function rekap(Request $request)
    {
        if ($request->ajax()) {
            // $date_start = null;
            // $date_end = null;
            // foreach ($request->all() as $key => $param) {
            //     if (isset($param['name'])) {
            //         if ($param['name'] === 'date_start') {
            //             $date_start = $param['value'];
            //             $date_start = $date_start . ' 00:00:00';
            //         } elseif ($param['name'] === 'date_end') {
            //             $date_end = $param['value'];
            //             $date_end = $date_end . ' 23:59:59';
            //         }
            //     }
            // }
            // // dd($date_end, $date_start);
            // $query =  Workout::selectRaw('workouts.*, a.name as user_name,a.qrcode as user_qrcode')
            //     ->join('users as a', 'a.id', '=', 'workouts.user_id');
            // // ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
            // // ->join('users as b', 'b.id', '=', 'workouts.doctor_id');
            // if ($date_start == $date_end) {
            //     $data = $query->whereDate('workouts.created_at', $date_start)->latest()->get();
            // } else {
            //     $data = $query->whereBetween('workouts.created_at', [$date_start, $date_end])->latest()->get();
            // }


            // new
            $date_start = null;
            $date_end = null;

            foreach ($request->all() as $key => $param) {
                if (isset($param['name'])) {
                    if ($param['name'] === 'year') {
                        $year = $param['value'];
                    } elseif ($param['name'] === 'month') {
                        $month = $param['value'];
                    } elseif ($param['name'] === 'week') {
                        $week = $param['value'];
                    }
                }
            }

            // Hitung tanggal mulai dan akhir berdasarkan minggu yang dipilih
            if (isset($year, $month, $week)) {
                // Mendapatkan hari pertama di bulan dan tahun yang dipilih
                $firstDayOfMonth = Carbon::createFromDate($year, $month, 1);

                // Hitung tanggal mulai berdasarkan minggu yang dipilih
                $date_start = $firstDayOfMonth->addWeeks($week - 1)->startOfWeek()->toDateTimeString();

                // Hitung tanggal akhir dari minggu tersebut
                $date_end = Carbon::createFromDate($year, $month, 1)
                    ->addWeeks($week - 1)
                    ->endOfWeek()
                    ->toDateTimeString();
            }

            // Debug untuk melihat tanggal yang dihitung
            // dd($date_start, $date_end);

            $query = Workout::selectRaw('workouts.*, a.name as user_name,fw.name as bagian, a.qrcode as user_qrcode')
                ->join('users as a', 'a.id', '=', 'workouts.user_id')
                ->join('field_works as fw', 'fw.id', '=', 'a.field_work_id');

            // Jika date_start dan date_end valid, filter berdasarkan range waktu
            if ($date_start && $date_end) {
                // dd($date_start, $date_end);
                // $data = $query->latest()->get();
                $data = $query->whereBetween('workouts.activity_date', [$date_start, $date_end])->latest()->get();
            } else {
                // Jika tidak ada filter, ambil semua data (sesuaikan logika ini jika perlu)
                $data = $query->latest()->get();
            }

            // dd($data);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('datescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
                })->addColumn('timescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('H:i');
                })->addColumn('evi_attch_span', function ($data) {
                    return Helpers::spanAttchSebuse($data->evi_attch);
                })->addColumn('evi_span', function ($data) {
                    return Helpers::spanStatusSebuse($data->evi_attch, $data->evi_status);
                })->addColumn('status_span', function ($data) {
                    return Helpers::spanStatusSebuse2($data->verif_status);
                })->addColumn('duration', function ($data) {
                    // return $data->hours . ':' . $data->minutes . ':' . $data->seconds;
                    return sprintf('%02d:%02d:%02d', $data->hours, $data->minutes, $data->seconds);

                    // return $data->hours . ' Jam ' .
                    //     ((!empty($data->seconds) || !empty($data->minutes)) ? ($data->minutes ?? 0) . ' Menit' : '') .
                    //     (!empty($data->seconds) ? ' ' . $data->seconds . ' Detik' : '');
                })->addColumn('pace', function ($data) {
                    $totalSeconds = ($data->hours * 3600) + ($data->minutes * 60) + $data->seconds;

                    if ($data->km_tempuh > 0) {
                        $paceInSeconds = $totalSeconds / $data->km_tempuh;
                        $paceMinutes = floor($paceInSeconds / 60);
                        $paceSeconds = round($paceInSeconds % 60);

                        return sprintf('%02d:%02d /km', $paceMinutes, $paceSeconds);
                    } else {
                        return '-';
                    }
                })->addColumn('aksi', function ($data) {
                    // return '<a href="' . route('detail-workout', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns([
                    'aksi',
                    'evi_attch_span',
                    'evi_span',
                    'temp_span',
                    'result_span',
                    'status_span'
                ])->make(true);
        }
        return view('page.workout.rekap', compact('request'));
    }

    public function scanner(Request $request)
    {
        return view('page.workout.scanner');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function scan_process($code)
    {
        try {
            $user = User::where('qrcode', $code)->firstOrFail();
            return $this->responseSuccess($user);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
        //
    }
    public function scanner_process($code)
    {
        try {
            // Cari user dengan qrcode yang valid
            $user = User::where('qrcode', $code)->firstOrFail();
            // dd($user->);
            // dd(Carbon::today());
            // Ambil workout terbaru hari ini
            $latestWorkout = Workout::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();




            // Jika tidak ada workout hari ini, kembalikan respon error
            // if (!$latestWorkout) {
            //     return $this->ResponseError("Belum ada workout hari ini");
            // }
            $user['workout'] = $latestWorkout;
            // Kembalikan respon sukses dengan data workout terbaru
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

    public function verif(Request $request)
    {
        try {
            $req = $request->validate([
                'id' => 'nullable|integer',
                // 'qrcode' => 'required|string',
                'verif_status' => 'required',
                'description' => 'nullable',
            ]);

            $workout = Workout::findOrFail($req['id']);
            // if (Helpers::spanSistole($req['sistole'], true) && Helpers::spanHr($req['hr'], true) && Helpers::spanTemp($req['temp'], true)) {
            //     $result = 'Y';
            // } else {
            //     $result = 'N';
            // }
            // $result = $this->getResult($req);
            // dd($result);
            $workout->verif_id =  Auth::user()->id;
            $workout->verif_status =  $req['verif_status'];
            $workout->description =  $req['description'];
            $workout->save();
            //     Workout::create($req);
            // }


            // Workout::create([
            //     'user_id' => $user->id,
            //     'doctor_id' => Auth::user()->id,
            //     'sistole' => $req['sistole'],
            //     'hr' =>  $req['hr'],
            //     'temp' => $req['temp'],
            //     'fitality' => $result,
            // ]);

            return $this->responseSuccess($req);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'qrcode' => 'required',
            'hours' => 'required|numeric',
            'minutes' => 'nullable|numeric',
            'seconds' => 'nullable|numeric',
            'km_tempuh' => 'required|numeric',
            'workout_jenis' => 'required|string',
            'activity_date' => 'nullable|date',
            'attachment_evi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $validatedData['seconds'] = $validatedData['seconds'] ?? 0;
        $validatedData['minutes'] = $validatedData['minutes'] ?? 0;
        $user = User::where('qrcode', $validatedData['qrcode'])->firstOrFail();

        // Ambil data Workout terbaru hari ini
        $latestWorkout = Workout::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        // Cek apakah file baru diunggah, jika tidak gunakan path yang sudah ada
        $path_evi = $request->file('attachment_evi') ? $this->storeFileWithUniqueName($request->file('attachment_evi'), 'upload/workout/evidance') : ($latestWorkout ? $latestWorkout->evi_attch : null);
        // Update atau buat data baru
        $latestWorkout = Workout::updateOrCreate(
            [
                'user_id' => $user->id, // Kondisi pencarian: user_id dan created_at hari ini
                'created_at' => Carbon::today(),
            ],
            [
                'km_tempuh' => $validatedData['km_tempuh'],
                'workout_jenis' => $validatedData['workout_jenis'],
                'hours' => $validatedData['hours'],
                'minutes' => $validatedData['minutes'],
                'seconds' => $validatedData['seconds'],
                'activity_date' => $validatedData['activity_date'],
                'evi_attch' => $path_evi,
            ]
        );

        return response()->json(['success' => 'Data berhasil diupload', 'workout' => $latestWorkout]);
    }
    function storeFileWithUniqueName($file, $directory)
    {
        if ($file) {
            $timestamp = time();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $originalName = str_replace(' ', '-', $originalName);  // Mengganti spasi dengan tanda "-"
            $extension = $file->getClientOriginalExtension();
            $filename = $timestamp . '_' . $originalName . '.' . $extension;
            return $file->storeAs($directory, $filename, 'public');
        }
        return null;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        // dd($filter);
        // echo "<prev>";
        // print_r($filter);
        // echo "</prev>";
        // echo json_encode($filter);
        // die();
        // $filter['date_start']  = $filter['date_start']  . ' 00:00:00';
        // $filter['date_end']  = $filter['date_end']  . ' 23:59:59';
        // // Atau ambil parameter tertentu
        // // $date_start = null;
        // // $date_end = null;
        // // if (isset($param['name'])) {
        // //     if ($param['name'] === 'date_start') {
        // //         $date_start = $param['value'];
        // //     } elseif ($param['name'] === 'date_end') {
        // //         $date_end = $param['value'];
        // //     }
        // // }
        // // dd($date_end, $date_start);
        // $query =  Workout::selectRaw('workouts.*, a.name as user_name,a.qrcode as user_qrcode, b.name verif_name')
        // ->join('users as a', 'a.id', '=', 'workouts.user_id')
        // ->leftJoin('users as b', 'b.id', '=', 'workouts.verif_id')->orderBy("workouts.created_at", "asc");
        // if ($filter['date_start'] == $filter['date_end']) {
        //     $data = $query->whereDate('workouts.created_at', $filter['date_start'])->latest()->get();
        // } else {
        //     $data = $query->whereBetween('workouts.created_at', [$filter['date_start'], $filter['date_end']])->latest()->get();
        // }

        $date_start = null;
        $date_end = null;

        // foreach ($request->all() as $key => $param) {
        // if (isset($filter['name'])) {
        //     if ($filter['year'] === 'year') {
        $year = $filter['year'];
        // } elseif ($filter['month'] === 'month') {
        $month = $filter['month'];
        // } elseif ($filter['name'] === 'week') {
        $week = $filter['week'];
        // }
        // }
        // }


        // Hitung tanggal mulai dan akhir berdasarkan minggu yang dipilih
        if (isset($year, $month, $week)) {
            // Mendapatkan hari pertama di bulan dan tahun yang dipilih
            $firstDayOfMonth = Carbon::createFromDate($year, $month, 1);

            // Hitung tanggal mulai berdasarkan minggu yang dipilih
            $date_start = $firstDayOfMonth->addWeeks($week - 1)->startOfWeek()->toDateTimeString();

            // Hitung tanggal akhir dari minggu tersebut
            $date_end = Carbon::createFromDate($year, $month, 1)
                ->addWeeks($week - 1)
                ->endOfWeek()
                ->toDateTimeString();

            // dd($firstDayOfMonth, $date_start, $date_end);
        }
        $filter['date_start'] = $date_start;
        $filter['date_end'] = $date_end;

        // Debug untuk melihat tanggal yang dihitung
        // dd($date_start, $date_end);

        $query = Workout::selectRaw('workouts.*, a.name as user_name, a.qrcode as user_qrcode')
            ->join('users as a', 'a.id', '=', 'workouts.user_id');

        // Jika date_start dan date_end valid, filter berdasarkan range waktu
        if ($date_start && $date_end) {
            $data = $query->whereBetween('workouts.created_at', [$date_start, $date_end])->latest()->get();
        } else {
            // Jika tidak ada filter, ambil semua data (sesuaikan logika ini jika perlu)
            $data = $query->latest()->get();
        }




        $filename = "dcu-rekap-" . $filter['date_start'] . '-sd-' . $filter['date_end'];
        $data =  Helpers::groupingSebuse($data);
        // dd($data);
        // $data = $query->get();
        return Excel::download(new ExportSebuse($data, $filter),  $filename . '.xlsx');
    }
}
