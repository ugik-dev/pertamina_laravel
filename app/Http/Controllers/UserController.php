<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Company;
use App\Models\Field;
use App\Models\Guarantor;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserGuarantor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $dataContent =  [
            'refRole' => Role::where('id', '<>', 6)->get(),
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
            $query = User::select('id', 'name');
            // Filter by 'id' if provided
            if (!empty($request->id)) {
                $query->where('id', $request->id);
            }

            // Filter by 'term' (search term) if provided
            if (!empty($request->searchTerm)) {
                $query->where('name', 'like', '%' . $request->searchTerm . '%');
            }

            // Limit the results and execute the query
            $users = $query->limit(20)->get();

            // Format data for Select2
            $data = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name,
                ];
            });

            // Return JSON response in the format needed by Select2
            return response()->json([
                'results' => $data
            ]);
        } catch (Exception $ex) {
            // Return error if an exception occurs
            return response()->json([
                'error' => $ex->getMessage()
            ], 500);
        }
    }


    public function select2_guarantor($user_id, Request $request)
    {
        try {
            $user = User::find($user_id);
            // dd($user);
            $query = UserGuarantor::where('user_id', $user->id)->orWhere('user_id', $user->tanggungan_id);
            $guarantors = $query->limit(20)->get();
            // dd($guarantors);

            // Format data for Select2
            $data = $guarantors->map(function ($guarantor) {
                return [
                    'id' => $guarantor->id,
                    'text' =>  $guarantor->pemilik->name . ' | ' . $guarantor->guarantor->name . ' | ' .
                        $guarantor->number,
                ];
            });

            // Return JSON response in the format needed by Select2
            return response()->json([
                'results' => $data
            ]);
        } catch (Exception $ex) {
            // Return error if an exception occurs
            return response()->json([
                'error' => $ex->getMessage()
            ], 500);
        }
    }



    public function get(Request $request)
    {
        try {
            $query =  User::withRole()->with(['unit', 'field_work', 'company'])->where('role_id', '<>', 6);
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->get()->toArray();
            $data =   DataStructure::keyValueObj($res, 'id');
            return $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }



    public function find(Request $request, $id)
    {
        try {
            $data =  User::withRole()->with(['unit', 'field_work', 'company', 'pentami', 'tanggungan'])->findOrFail($id);
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
                'sip' => $request->sip,
                // 'guarantor_number' => $request->guarantor_number,
                'empoyee_id' => $request->empoyee_id,
                'gender' => $request->gender,
                // 'guarantor_id' => $request->guarantor_id,
                'password' => Hash::make($request->password),
                'pola' => $request->pola
            ];

            $data = User::create($att);
            if ($request->guarantor_id)
                foreach ($request->guarantor_id as $key => $guard) {
                    if (!empty($request->guarantor_number[$key]) && !empty($request->guarantor_id[$key])) {
                        UserGuarantor::create([
                            'user_id' => $data->id,
                            'guarantor_id' => $request->guarantor_id[$key],
                            'number' => $request->guarantor_number[$key]
                        ]);
                    }
                }
            if ($request->tanggungan_name)
                foreach ($request->tanggungan_name as $key => $tannguhan) {
                    if (!empty($request->tanggungan_name[$key]) && !empty($request->tanggungan_st[$key])) {
                        User::create([
                            'tanggungan_id' => $data->id,
                            'tanggungan_st' => $request->tanggungan_st[$key],
                            'name' => $request->tanggungan_name[$key],
                            'dob' => $request->tanggungan_dob[$key],
                            'gender' => $request->tanggungan_jk[$key],
                            'role_id' => 6
                        ]);
                    }
                }
            $data = User::withRole()->with(['unit', 'field_work'])->find($data->id);
            if (!empty($request->role_id)) {
                $role =  Role::find($request->role_id);
                $data->syncRoles($role);
                \Artisan::call('permission:cache-reset');
            }
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
                'empoyee_id' => $request->empoyee_id,
                'gender' => $request->gender,
                'sip' => $request->sip,
                'pola' => $request->pola
            ]);
            if (!empty($request->password))
                $data->update([
                    'password' => Hash::make($request->password),
                ]);


            $arrGuarantor = [];
            if ($request->guarantor_id)
                foreach ($request->guarantor_id as $key => $guard) {
                    if (!empty($request->guarantor_number[$key]) && !empty($request->guarantor_id[$key])) {
                        $userG = UserGuarantor::updateOrCreate(
                            [
                                'user_id' => $data->id,
                                'guarantor_id' => $request->guarantor_id[$key],
                            ],
                            ['number' => $request->guarantor_number[$key]]
                        );
                        $arrGuarantor[] = $userG->id;
                    }
                }

            UserGuarantor::where('user_id', $data->id)->whereNotIn('id', $arrGuarantor)->delete();
            // dd($arrGuarantor);

            // tanggungan
            $arrTanggungan = [];
            if ($request->tanggungan_name)
                foreach ($request->tanggungan_name as $key => $tannguhan) {
                    if (!empty($request->tanggungan_name[$key]) && !empty($request->tanggungan_st[$key])) {
                        if (empty($request->tanggungan_cur_id[$key])) {
                            // dd("m");
                            $userT = User::create(
                                [
                                    'tanggungan_id' => $data->id,
                                    'tanggungan_st' => $request->tanggungan_st[$key],
                                    'name' => $request->tanggungan_name[$key],
                                    'dob' => $request->tanggungan_dob[$key],
                                    'gender' => $request->tanggungan_jk[$key],
                                    'role_id' => 6
                                ]
                            );
                            $arrTanggungan[] = $userT->id;
                        } else {
                            User::where('id', $request->tanggungan_cur_id[$key])
                                ->update([
                                    'tanggungan_st' => $request->tanggungan_st[$key],
                                    'name' => $request->tanggungan_name[$key],
                                    'dob' => $request->tanggungan_dob[$key],
                                    'gender' => $request->tanggungan_jk[$key],
                                ]);
                            $arrTanggungan[] = $request->tanggungan_cur_id[$key];
                        }
                        // dd($arrTanggungan);
                    }
                }
            User::where('tanggungan_id', $data->id)->whereNotIn('id', $arrTanggungan)->delete();


            $data = User::withRole()->with(['unit', 'field_work', 'company', 'pentami', 'tanggungan'])->findOrFail($request->id);
            if (!empty($request->role_id)) {
                $role =  Role::find($request->role_id);
                $data->syncRoles($role);
                \Artisan::call('permission:cache-reset');
            }
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
