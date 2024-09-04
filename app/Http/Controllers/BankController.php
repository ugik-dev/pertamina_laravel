<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\RefBank;
use Illuminate\Http\Request;
use App\Helpers\DataStructure;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refBank' => RefBank::get(),
            'refUser' => User::select('id', 'name')->get(),
        ];
        // dd($dataContent);
        return view('page.bank.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  Bank::with(['ref_bank', 'owner']);
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->get()->toArray();
            $data =   DataStructure::keyValueObj($res, 'id');

            return $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $att = [
                'description' => $request->description,
                'doc_date' => $request->doc_date,
                'ref_bank_id' => $request->ref_bank_id,
                'user_id' => $request->user_id,
                'upload_by' => Auth::user()->id,
            ];

            $data = Bank::create($att);
            $data = Bank::with('ref_bank')->find($data->id);

            // $request->validate([
            //     'file_attachment' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Add appropriate validation rules
            // ]);

            if ($request->hasFile('file_attachment')) {
                $photo = $request->file('file_attachment');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/bank', $originalFilename, 'public');
                $data->filename = $originalFilename;
                $data->save();
            }

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function show(string $slug)
    {
        try {
            $query =  Bank::with('ref_bank');
            $query->where('slug', '=', $slug);
            $res = $query->get()->first();
            return view('page.bank.show', ['dataContent' => $res]);
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
            $data = Bank::with('ref_bank')->findOrFail($request->id);
            $att = [
                'description' => $request->description,
                'doc_date' => $request->doc_date,
                'ref_bank_id' => $request->ref_bank_id,
                'upload_by' => Auth::user()->id,
                'user_id' => $request->user_id,


            ];
            if ($request->description != $data->description)
                $att['slug'] = Bank::createUniqueSlug($request->description, $request->id);

            if ($request->hasFile('file_attachment')) {
                $photo = $request->file('file_attachment');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/bank', $originalFilename, 'public');
                // dd($path);
                $att['filename']  = $originalFilename;
            }
            $data->update($att);
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Bank::with('ref_bank')->findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
