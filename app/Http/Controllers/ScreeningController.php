<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Form;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data =  Screening::selectRaw('screenings.*, a.name as user_name, b.name doctor_name')
                ->join('users as a', 'a.id', '=', 'screenings.user_id')
                ->join('users as b', 'b.id', '=', 'screenings.doctor_id')
                ->whereDate('screenings.created_at', Carbon::today())
                ->latest()->get();
            return DataTables::of($data)->addColumn('timescan', function ($data) {
                return \Carbon\Carbon::parse($data->created_at)->format('H:i');
            })->addColumn('sistole_span', function ($data) {
                return Helpers::spanSistole($data->sistole);
            })->addColumn('hr_span', function ($data) {
                return Helpers::spanHr($data->hr);
            })->addColumn('temp_span', function ($data) {
                return Helpers::spanTemp($data->temp);
            })->addColumn('result_span', function ($data) {
                return $data->fitality == 'Y' ? "<span class='text-success'>FIT</span>" : "<span class='text-danger'>UNFIT</span>";
            })->addColumn('aksi', function ($data) {
                // return '<a href="' . route('detail-screening', $data->id) . '" class="btn btn-primary">Open</a>';
                return '<a href="" class="btn btn-primary">Open</a>';
            })->rawColumns(['aksi', 'sistole_span', 'hr_span', 'temp_span', 'result_span'])->make(true);
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
                    } elseif ($param['name'] === 'date_end') {
                        $date_end = $param['value'];
                    }
                }
            }
            // dd($date_end, $date_start);
            $data =  Screening::selectRaw('screenings.*, a.name as user_name, b.name doctor_name')
                ->join('users as a', 'a.id', '=', 'screenings.user_id')
                ->join('users as b', 'b.id', '=', 'screenings.doctor_id')
                ->whereBetween('screenings.created_at', [$date_start, $date_end])
                ->latest()->get();
            return DataTables::of($data)->addColumn('datescan', function ($data) {
                return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
            })->addColumn('timescan', function ($data) {
                return \Carbon\Carbon::parse($data->created_at)->format('H:i');
            })->addColumn('sistole_span', function ($data) {
                return Helpers::spanSistole($data->sistole);
            })->addColumn('hr_span', function ($data) {
                return Helpers::spanHr($data->hr);
            })->addColumn('temp_span', function ($data) {
                return Helpers::spanTemp($data->temp);
            })->addColumn('result_span', function ($data) {
                return $data->fitality == 'Y' ? "<span class='text-success'>FIT</span>" : "<span class='text-danger'>UNFIT</span>";
            })->addColumn('aksi', function ($data) {
                // return '<a href="' . route('detail-screening', $data->id) . '" class="btn btn-primary">Open</a>';
                return '<a href="" class="btn btn-primary">Open</a>';
            })->rawColumns(['aksi', 'sistole_span', 'hr_span', 'temp_span', 'result_span'])->make(true);
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
            $user = User::where('qrcode', $code)->validFitality()->firstOrFail();

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


    public function create(Request $request)
    {
        try {
            $req = $request->validate([
                'qrcode' => 'required|string',
                'name' => 'required|string|max:255',
                'sistole' => 'required',
                'diastole' => 'required',
                'fisik' => 'required',
                'hr' => 'required',
                'temp' => 'required',
                'rr' => 'required',
                'spo2' => 'nullable',
                'romberg' => 'nullable',
                'alcohol' => 'nullable',
                'alcohol_level' => 'nullable',
                'anamnesis' => 'nullable',
                'description' => 'nullable',
            ]);

            $user = User::where('qrcode', $req['qrcode'])->firstOrFail();
            if (Helpers::spanSistole($req['sistole'], true) && Helpers::spanHr($req['hr'], true) && Helpers::spanTemp($req['temp'], true)) {
                $result = 'Y';
            } else {
                $result = 'N';
            }
            $req['fitality'] = $result;
            $req['doctor_id'] =  Auth::user()->id;
            $req['user_id'] =  $user->id;
            Screening::create($req);

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
}
