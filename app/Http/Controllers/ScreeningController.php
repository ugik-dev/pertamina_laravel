<?php

namespace App\Http\Controllers;

use App\Exports\ExportDCU;
use App\Helpers\Helpers;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ScreeningController extends Controller
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
        $data =  RequestCall::selectRaw('request_calls.*, login_session.name, login_session.phone, ref_emergencies.name as screening_name')
            ->join('login_session', 'login_session.id', '=', 'request_calls.login_session_id')
            ->join('ref_emergencies', 'ref_emergencies.id', '=', 'request_calls.ref_screening_id')
            ->where('request_calls.id', '=', $request->id_request)
            ->get()->first();

        return $this->responseSuccess(['success', 'data' => $data]);
    }

    public function detail($id, Request $request)
    {
        $data = RequestCall::with(['login_session', 'ref_screening', 'logs.user', 'forms', 'forms.user'])
            ->findOrFail($id);
        // dd($data);
        $dataContent = $data;
        return view('page.screening.detail', compact('dataContent'));
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $date = $request->input('filter.screening_date')
                ? Carbon::parse($request->input('filter.screening_date'))->format('Y-m-d')
                : Carbon::today()->format('Y-m-d');
            $status = $request->input('filter.screening_status');
            // $query =  Screening::selectRaw('screenings.*, a.name as user_name,a.qrcode as user_qrcode, b.name doctor_name, f.high_risk')
            //     ->join('users as a', 'a.id', '=', 'screenings.user_id')
            //     ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
            //     ->join('users as b', 'b.id', '=', 'screenings.doctor_id')
            //     ->whereDate('screenings.created_at', $date);
            $query = DB::table('users as a') // Mulai dari tabel users
                ->selectRaw('screenings.*, a.name as user_name, a.qrcode as user_qrcode, b.name as doctor_name, f.high_risk')
                ->leftJoin('screenings', function ($join) use ($date) {
                    $join->on('screenings.user_id', '=', 'a.id')
                        ->whereDate('screenings.created_at', $date);
                })
                ->leftJoin('field_works as f', 'a.field_work_id', '=', 'f.id')
                ->leftJoin('users as b', 'b.id', '=', 'screenings.doctor_id');

            if (!empty($status)) {
                if ($status == 'fit') {
                    $query->where("fitality", "=", "Y");
                } else if ($status == 'unfit') {
                    $query->where("fitality", "=", "N");
                } else if ($status == 'hasScreening') {
                    $query->whereNotNull("screenings.id");
                } elseif ($status == 'notScreening') {
                    $query->whereNull("screenings.id");
                }
            }
            // ->whereDate('screenings.created_at', "2024-09-06")
            // ->latest()->get();
            // ->get();
            $data = $query->get();
            // dd($data);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('timescan', function ($data) {
                    return $data->id ?  \Carbon\Carbon::parse($data->created_at)->format('H:i') : '-';
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
                    return $data->fitality == 'Y' ? "<span class='text-success'>FIT</span>" : ($data->fitality == 'N' ?  "<span class='text-danger'>UNFIT</span>" : '-');
                })->addColumn('high_risk_span', function ($data) {
                    return Helpers::spanRisk($data->high_risk);
                })->addColumn('aksi', function ($data) {
                    // return '<a href="' . route('detail-screening', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns(['aksi', 'high_risk_span', 'sistole_span', 'diastole_span', 'hr_span', 'rr_span', 'spo2_span', 'temp_span', 'result_span', 'romberg_span', 'alcohol_span'])->make(true);
        }
        return view('page.screening.index', compact('request'));
    }

    public function rekap(Request $request)
    {
        if ($request->ajax()) {
            $date_start = null;
            $date_end = null;
            foreach ($request->all() as $key => $param) {
                if (isset($param['name'])) {
                    if ($param['name'] === 'date_start') {
                        $date_start = $param['value'];
                        $date_start = $date_start . ' 00:00:00';
                    } elseif ($param['name'] === 'date_end') {
                        $date_end = $param['value'];
                        $date_end = $date_end . ' 23:59:59';
                    }
                }
            }
            // dd($date_end, $date_start);
            $query =  Screening::selectRaw('screenings.*, a.name as user_name,a.qrcode as user_qrcode, b.name doctor_name,f.high_risk')
                ->join('users as a', 'a.id', '=', 'screenings.user_id')
                ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
                ->join('users as b', 'b.id', '=', 'screenings.doctor_id');
            if ($date_start == $date_end) {
                $data = $query->whereDate('screenings.created_at', $date_start)->latest()->get();
            } else {
                $data = $query->whereBetween('screenings.created_at', [$date_start, $date_end])->latest()->get();
            }
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('datescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
                })->addColumn('timescan', function ($data) {
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
                    // return '<a href="' . route('detail-screening', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns([
                    'aksi',
                    'high_risk_span',
                    'sistole_span',
                    'diastole_span',
                    'hr_span',
                    'rr_span',
                    'spo2_span',
                    'temp_span',
                    'result_span',
                    'romberg_span',
                    'alcohol_span'
                ])->make(true);
        }
        return view('page.screening.rekap', compact('request'));
    }

    public function scanner(Request $request)
    {
        return view('page.screening.scanner');
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

    public function create(Request $request)
    {
        try {
            $req = $request->validate([
                'id' => 'nullable|integer',
                'qrcode' => 'required|string',
                'name' => 'required|string|max:255',
                'sistole' => 'required',
                'diastole' => 'required',
                'fisik' => 'required',
                'hr' => 'required',
                'temp' => 'required',
                'rr' => 'required',
                'spo2' => 'required',
                'romberg' => 'required',
                'alcohol' => 'required',
                'alcohol_level' => 'nullable',
                'anamnesis' => 'nullable',
                'description' => 'nullable',
            ]);

            $user = User::where('qrcode', $req['qrcode'])->firstOrFail();
            // if (Helpers::spanSistole($req['sistole'], true) && Helpers::spanHr($req['hr'], true) && Helpers::spanTemp($req['temp'], true)) {
            //     $result = 'Y';
            // } else {
            //     $result = 'N';
            // }
            $result = $this->getResult($req);
            // dd($result);
            $req['fitality'] = $result;
            $req['doctor_id'] =  Auth::user()->id;
            $req['user_id'] =  $user->id;
            if (!empty($req["id"])) {
                // $req['description'] =  $req['description'] . " | Pemeriksaan lanjutan";
                unset($req['qrcode']);
                unset($req['name']);
                Screening::where("id", $req["id"])->update($req);
            } else {
                $cek = Screening::where("user_id", '=', $user->id)
                    ->whereDate("created_at", Carbon::today())->count();
                if ($cek > 0)
                    $req['description'] =  ($req['description'] ? $req['description'] . ", " : "") . "Pemeriksaan ke-" . ($cek + 1);

                Screening::create($req);
            }


            // Screening::create([
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
        //
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
