<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\LoginSession;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RekapController extends Controller
{
    public function tindakan(Request $request)
    {
        if ($request->ajax()) {
            $data =  Form::latest()->get();
            return DataTables::of($data)->addColumn('id', function ($data) {
                return $data->id;
            })->addColumn('created_at', function ($data) {
                return $data->created_at;
            })->addColumn('nama_pasien', function ($data) {
                return $data->nama_pasien;
            })->addColumn('umur', function ($data) {
                return $data->umur;
            })->addColumn('aksi', function ($data) {
                return '
                <a href="' . route('tindakan.print', ['id' => $data->id,  'format' => '2']) . '" target="_blank" class="btn btn-primary">Print</a>
                <a href="' . route('tindakan.edit', ['id' => $data->id,]) . '" target="_blank" class="btn btn-primary">Edit</a>
                ';
            })->rawColumns(['aksi'])->make(true);
        }
        return view('page.rekap.tindakan', compact('request'));
    }
    public function tindakan_get(Request $request)
    {
        $data =  RequestCall::selectRaw('request_calls.*, login_session.name, login_session.phone, ref_emergencies.name as emergency_name')
            ->join('login_session', 'login_session.id', '=', 'request_calls.login_session_id')
            ->join('ref_emergencies', 'ref_emergencies.id', '=', 'request_calls.ref_emergency_id')
            ->where('request_calls.id', '=', $request->id_request)
            ->get()->first();

        return $this->responseSuccess(['success', 'data' => $data]);
    }
}
