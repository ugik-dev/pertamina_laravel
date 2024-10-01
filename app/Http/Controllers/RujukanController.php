<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\LoginSession;
use App\Models\Refferal;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RujukanController extends Controller
{
    public function form_fresh(Request $request)
    {
        return $this->form(null, $request);
    }

    public function form($id, Request $request)
    {

        $dataContent = null;
        $form_url = route('rujukan.save');
        $refUsers = User::select("id", "name")->get();
        return view('page.rujukan.form', compact('dataContent', 'form_url', 'refUsers'));
    }

    public function form_edit($id, Request $request)
    {
        $data = Refferal::findOrFail($id);
        // dd($data->doctor);
        // $data_all = Form::with('user')->find($id);
        $form_url = route('rujukan.save-edit', ['id' => $data->id,]);
        $compact = ['dataContent' => $data, 'form_url' => $form_url, 'dataForm' => $data];
        return view('page.rujukan.form', $compact);
    }

    public function form_edit_fresh($id)
    {
        $data_all = Form::with('user')->find($id);
        $form_url = route('rujukan.save-edit', ['id' => $data_all->id]);
        $compact = ['form_url' => $form_url, 'dataForm' => $data_all];
        return view('page.rujukan.form', $compact);
    }

    public function form_save_new_fresh(Request $request)
    {
        try {
            return $this->form_save(null, null, $request);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
    public function form_save_edit($id, Request $request)
    {
        try {
            return $this->form_save($id, null, $request);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function form_save($id, $id_form = null,  Request $request)
    {
        try {
            if ($id) {
                $data = Refferal::findOrFail($id);
            }

            $formData = $request->except(['_token', 'gambar']);



            if (!empty($id)) {
                $data->update($formData);
            } else {
                $res = Refferal::create($formData);
                $id =  $res->id;

                // if ($request->hasFile('gambar')) {
                //     $photo = $request->file('gambar');
                //     $path = $photo->storeAs('upload/tindakan',  $id . '.png', 'public');
                //     $res->gambar = $id . '.png';
                //     $res->save();
                // }
            }





            return $this->responseSuccess($id);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function action($id, $act = null, Request $request)
    {
        $data = RequestCall::with(['login_session', 'ref_rujukan'])
            ->findOrFail($id);
        if (!empty($act)) {
            if ($act == 'pick-off') {
                RequestCallLog::create([
                    'request_call_id' => $data->id,
                    'user_id' => Auth::user()->id,
                    'action' => 'pick-off'
                ]);
            }
        }
        $data = RequestCall::with(['login_session', 'ref_rujukan', 'logs.user'])
            ->findOrFail($id);
        return view('page.rujukan.detail', ['dataContent' => $data]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  Refferal::latest()->get();
            // $data =  Refferal::where('id', 4)->get();
            // dd($data[0]->assist ? 'null' : 'x');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('id', function ($data) {
                    return $data->id;
                })->addColumn('pasien_name', function ($data) {
                    return $data->pasien->name ?? '';
                })->addColumn('doctor_name', function ($data) {
                    return $data->doctor->name ?? '';
                })->addColumn('assist_name', function ($data) {
                    return  $data->assist->name ?? '';
                })->addColumn('span_time', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d h:i');
                })->addColumn('aksi', function ($data) {
                    return '
                    <a href="' . route('rujukan.open', $data->id) . '" class="btn btn-primary">Open</a>
                    <a href="' . route('rujukan.edit', $data->id) . '" class="btn btn-warning">Edit</a>
                    <button data-id="' .  $data->id . '" class="delBtn btn btn-danger">Hapus</button>
                    ';
                })->rawColumns(['aksi'])->make(true);
        }
        return view('page.rujukan.index', compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function destroy(Request $request)
    {
        try {
            $data = Refferal::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
