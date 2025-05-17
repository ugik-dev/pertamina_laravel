<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\McuReview;
use App\Models\ReviewDrug;
use App\Models\RequestCall;
use App\Models\RequestCallLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ApprovalController extends Controller
{



    public function pengantar(Request $request)
    {
        if ($request->ajax()) {
            $data =  McuReview::where('source_data', "!=", "Excel")->with('batch', 'labor')->latest()->get();
            // $data =  Review::where('id', 4)->get();
            // dd($data[0]->assist ? 'null' : 'x');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('id', function ($data) {
                    return $data->id;
                })->addColumn('pasien_name', function ($data) {
                    return $data->batch->nama ?? '';
                })->addColumn('periode', function ($data) {
                    return $data->date_start . ' s/d ' . $data->date_end;
                })->addColumn('labor_name', function ($data) {
                    return  $data->labor->name ?? '';
                })->addColumn('span_time', function ($data) {
                    return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d h:i');
                })->addColumn('aksi', function ($data) {
                    $aksi = '<div class="d-inline-block">
                <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end m-0">';

                    // Print Draft button
                    $aksi .= '<li><a href="' . route('mcu.print-pengantar', $data->id) . '" class="dropdown-item"><i class="mdi mdi-printer"></i> Print </a></li>';

                    // Edit button
                    $aksi .= '<li><button class="dropdown-item approv-btn" data-id="' . $data->id . '"><i class="mdi mdi-check-circle"></i> Approv</button></li>';

                    // // Upload button
                    // $aksi .= '<li><a href="' . route('review.upload', $data->id) . '" class="dropdown-item"><i class="mdi mdi-cloud-upload"></i> Upload</a></li>';

                    // Check if file_tte is not null before showing TTE button
                    // if (!is_null($data->file_tte)) {
                    //     $aksi .= '<li><a target="_blank" href="' . url('storage/upload/tte', $data->file_tte) . '" class="dropdown-item"><i class="mdi mdi-file-document-outline"></i> TTE</a></li>';
                    // }

                    // Delete button
                    // $aksi .= '<li><button href="javascript:;" data-id="' . $data->id . '" class="delete delBtn dropdown-item text-danger"><i class="mdi mdi-trash-can-outline"></i> Hapus</button></li>';

                    // Close dropdown structure
                    $aksi .= '</ul></div>';

                    return $aksi;
                })->rawColumns(['aksi'])->make(true);
        }
        return view('page.request.pengantar', compact('request'));
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
    public function aksi_pengantar(Request $request)
    {
        try {
            $query =  McuReview::where('source_data', "!=", "Excel")->with('batch', 'labor');
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->first();

            if ($request->action == "approved" && $res->status == "draft_pengantar") {
                $res->status = 'approved_pengantar';
            }
            $res->save();

            return $this->responseSuccess($res);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
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
}
