<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Company;
use App\Models\Field;
use App\Models\Guarantor;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $dataContent =  [
            'refRole' => Role::get(),
            'refUnit' => Unit::get(),
            'refField' => Field::get(),
            'refCompany' => Company::get(),
            'refGuarantor' => Guarantor::get(),
        ];
        return view('page.agent.index', compact('request', 'dataContent'));
    }
    public function select2(Request $request)
    {
        try {
            // Query dengan relasi yang dibutuhkan
            $query = User::select('id', 'name');
            // Jika ada parameter 'id', ambil berdasarkan id
            if (!empty($request->id)) {
                $query->where('id', $request->id);
            }

            // Jika ada parameter 'term' (biasanya untuk pencarian), filter berdasarkan term
            if (!empty($request->searchTerm)) {
                $query->where('name', 'like', '%' . $request->searchTerm . '%');
            }

            // Ambil hasil query
            $users = $query->get();

            // Format data untuk Select2
            $data = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name // Ini yang akan ditampilkan di dropdown Select2
                ];
            });

            // Mengembalikan response dalam format JSON sesuai dengan kebutuhan Select2
            return response()->json([
                'results' => $data
            ]);
        } catch (Exception $ex) {
            // Kembalikan error jika terjadi exception
            return response()->json([
                'error' => $ex->getMessage()
            ], 500);
        }
    }


    public function get(Request $request)
    {
        try {
            $query =  User::withRole()->with(['unit', 'field_work', 'company']);
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
                'name' => $request->name,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'unit_id' => $request->unit_id,
                'field_work_id' => $request->field_work_id,
                'company_id' => $request->company_id,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'qrcode' => $request->qrcode,
                'email' => $request->email,
                'dob' => $request->dob,
                'rm_number' => $request->rm_number,
                'guarantor_number' => $request->guarantor_number,
                'empoyee_id' => $request->empoyee_id,
                'gender' => $request->gender,
                'guarantor_id' => $request->guarantor_id,
                'password' => Hash::make($request->password),
            ];
            $data = User::create($att);
            $data = User::withRole()->with(['unit', 'field_work'])->find($data->id);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);

            $data->update([
                'name' => $request->name,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'unit_id' => $request->unit_id,
                'field_work_id' => $request->field_work_id,
                'alamat' => $request->alamat,
                'qrcode' => $request->qrcode,
                'phone' => $request->phone,
                'email' => $request->email,
                'dob' => $request->dob,
                'rm_number' => $request->rm_number,
                'company_id' => $request->company_id,
                'guarantor_number' => $request->guarantor_number,
                'empoyee_id' => $request->empoyee_id,
                'gender' => $request->gender,
                'guarantor_id' => $request->guarantor_id,
            ]);
            if (!empty($request->password))
                $data->update([
                    'password' => Hash::make($request->password),
                ]);
            $data = User::withRole()->with(['unit', 'field_work'])->findOrFail($request->id);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
