<?php

namespace App\Http\Controllers;

use App\Exports\ExportSebuse;
use App\Helpers\Helpers;
use App\Models\Form;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\Sebuse;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SebuseController extends Controller
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
        $data =  RequestCall::selectRaw('request_calls.*, login_session.name, login_session.phone, ref_emergencies.name as sebuse_name')
            ->join('login_session', 'login_session.id', '=', 'request_calls.login_session_id')
            ->join('ref_emergencies', 'ref_emergencies.id', '=', 'request_calls.ref_sebuse_id')
            ->where('request_calls.id', '=', $request->id_request)
            ->get()->first();

        return $this->responseSuccess(['success', 'data' => $data]);
    }

    public function detail($id, Request $request)
    {
        $data = RequestCall::with(['login_session', 'ref_sebuse', 'logs.user', 'forms', 'forms.user'])
            ->findOrFail($id);
        // dd($data);
        $dataContent = $data;
        return view('page.sebuse.detail', compact('dataContent'));
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  Sebuse::selectRaw('sebuses.*, a.name as user_name,a.qrcode as user_qrcode, b.name doctor_name, f.high_risk')
                ->join('users as a', 'a.id', '=', 'sebuses.user_id')
                ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
                ->join('users as b', 'b.id', '=', 'sebuses.doctor_id')
                ->whereDate('sebuses.created_at', Carbon::today())
                // ->whereDate('sebuses.created_at', "2024-09-06")
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
                    // return '<a href="' . route('detail-sebuse', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns(['aksi', 'high_risk_span', 'sistole_span', 'diastole_span', 'hr_span', 'rr_span', 'spo2_span', 'temp_span', 'result_span', 'romberg_span', 'alcohol_span'])->make(true);
        }
        return view('page.sebuse.index', compact('request'));
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
            $query =  Sebuse::selectRaw('sebuses.*, a.name as user_name,a.qrcode as user_qrcode')
                ->join('users as a', 'a.id', '=', 'sebuses.user_id');
            // ->join('field_works as f', 'a.field_work_id', '=', 'f.id')
            // ->join('users as b', 'b.id', '=', 'sebuses.doctor_id');
            if ($date_start == $date_end) {
                $data = $query->whereDate('sebuses.created_at', $date_start)->latest()->get();
            } else {
                $data = $query->whereBetween('sebuses.created_at', [$date_start, $date_end])->latest()->get();
            }
            // dd($data);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('datescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
                })->addColumn('timescan', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('H:i');
                })->addColumn('kal_attch_span', function ($data) {
                    return Helpers::spanAttchSebuse($data->kal_attch);
                })->addColumn('gym_attch_span', function ($data) {
                    return Helpers::spanAttchSebuse($data->gym_attch);
                })->addColumn('str_attch_span', function ($data) {
                    return Helpers::spanAttchSebuse($data->str_attch);
                })->addColumn('mkn_attch_span', function ($data) {
                    return Helpers::spanAttchSebuse($data->mkn_attch);
                })->addColumn('kal_span', function ($data) {
                    return Helpers::spanStatusSebuse($data->kal_attch, $data->kal_status);
                })->addColumn('status_span', function ($data) {
                    return Helpers::spanStatusSebuse2($data->verif_status);
                })->addColumn('aksi', function ($data) {
                    // return '<a href="' . route('detail-sebuse', $data->id) . '" class="btn btn-primary">Open</a>';
                    return '<button data-id="' . $data->id . '" class="editBtn btn btn-primary"><i class="mdi mdi-pencil"></i></button>';
                })->rawColumns([
                    'aksi',
                    'kal_attch_span',
                    'kal_span',
                    'gym_span',
                    'gym_attch_span',
                    'str_span',
                    'str_attch_span',
                    'mkn_span',
                    'mkn_attch_span',
                    'temp_span',
                    'result_span',
                    'status_span'
                ])->make(true);
        }
        return view('page.sebuse.rekap', compact('request'));
    }

    public function scanner(Request $request)
    {
        return view('page.sebuse.scanner');
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
            // Ambil sebuse terbaru hari ini
            $latestSebuse = Sebuse::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();




            // Jika tidak ada sebuse hari ini, kembalikan respon error
            // if (!$latestSebuse) {
            //     return $this->ResponseError("Belum ada sebuse hari ini");
            // }
            $user['sebuse'] = $latestSebuse;
            // Kembalikan respon sukses dengan data sebuse terbaru
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

            $sebuse = Sebuse::findOrFail($req['id']);
            // if (Helpers::spanSistole($req['sistole'], true) && Helpers::spanHr($req['hr'], true) && Helpers::spanTemp($req['temp'], true)) {
            //     $result = 'Y';
            // } else {
            //     $result = 'N';
            // }
            // $result = $this->getResult($req);
            // dd($result);
            $sebuse->verif_id =  Auth::user()->id;
            $sebuse->verif_status =  $req['verif_status'];
            $sebuse->description =  $req['description'];
            $sebuse->save();
            //     Sebuse::create($req);
            // }


            // Sebuse::create([
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
            'kal' => 'required|numeric',
            'attachment_kal' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'attachment_str' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'attachment_gym' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'attachment_mkn' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = User::where('qrcode', $validatedData['qrcode'])->firstOrFail();

        // Ambil data Sebuse terbaru hari ini
        $latestSebuse = Sebuse::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        // Cek apakah file baru diunggah, jika tidak gunakan path yang sudah ada
        $path_kal = $request->file('attachment_kal') ? $this->storeFileWithUniqueName($request->file('attachment_kal'), 'upload/sebuse/kalori') : ($latestSebuse ? $latestSebuse->kal_attch : null);
        $path_str = $request->file('attachment_str') ? $this->storeFileWithUniqueName($request->file('attachment_str'), 'upload/sebuse/streching') : ($latestSebuse ? $latestSebuse->str_attch : null);
        $path_gym = $request->file('attachment_gym') ? $this->storeFileWithUniqueName($request->file('attachment_gym'), 'upload/sebuse/gym') : ($latestSebuse ? $latestSebuse->gym_attch : null);
        $path_mkn = $request->file('attachment_mkn') ? $this->storeFileWithUniqueName($request->file('attachment_mkn'), 'upload/sebuse/makansehat') : ($latestSebuse ? $latestSebuse->mkn_attch : null);

        // Update atau buat data baru
        $latestSebuse = Sebuse::updateOrCreate(
            [
                'user_id' => $user->id, // Kondisi pencarian: user_id dan created_at hari ini
                'created_at' => Carbon::today(),
            ],
            [
                'kal_val' => $validatedData['kal'],
                'kal_attch' => $path_kal,
                // 'kal_status' => $request->file('attachment_kal') ? 'Y' : ($latestSebuse ? $latestSebuse->kal_status : 'N'),

                'str_val' => $request->file('attachment_str') ? 1 : ($latestSebuse ? $latestSebuse->str_val : null), // Ganti nilai default jika diperlukan
                'str_attch' => $path_str,
                // 'str_status' => $request->file('attachment_str') ? 'Y' : ($latestSebuse ? $latestSebuse->str_status : 'N'),

                'gym_val' => $request->file('attachment_gym') ? 1 : ($latestSebuse ? $latestSebuse->gym_val : null), // Ganti nilai default jika diperlukan
                'gym_attch' => $path_gym,
                // 'gym_status' => $request->file('attachment_gym') ? 'Y' : ($latestSebuse ? $latestSebuse->gym_status : 'N'),

                'mkn_val' => $request->file('attachment_mkn') ? 1 : ($latestSebuse ? $latestSebuse->mkn_val : null), // Ganti nilai default jika diperlukan
                'mkn_attch' => $path_mkn,
                // 'mkn_status' => $request->file('attachment_mkn') ? 'Y' : ($latestSebuse ? $latestSebuse->mkn_status : 'N'),
                'kal_status' => 'N',
            ]
        );

        return response()->json(['success' => 'Data berhasil diupload', 'sebuse' => $latestSebuse]);
    }
    function storeFileWithUniqueName($file, $directory)
    {
        if ($file) {
            $timestamp = time();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $timestamp . '_' . $originalName .  '.' . $extension;
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
        $query =  Sebuse::selectRaw('sebuses.*, a.name as user_name,a.qrcode as user_qrcode, b.name verif_name')
            ->join('users as a', 'a.id', '=', 'sebuses.user_id')
            ->leftJoin('users as b', 'b.id', '=', 'sebuses.verif_id')->orderBy("sebuses.created_at", "asc");
        if ($filter['date_start'] == $filter['date_end']) {
            $data = $query->whereDate('sebuses.created_at', $filter['date_start'])->latest()->get();
        } else {
            $data = $query->whereBetween('sebuses.created_at', [$filter['date_start'], $filter['date_end']])->latest()->get();
        }
        $data =  Helpers::groupingSebuse($data);
        // dd($data);
        // $data = $query->get();
        return Excel::download(new ExportSebuse($data, $filter),  $filename . '.xlsx');
    }
}
