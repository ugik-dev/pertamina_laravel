<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
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
        ];
        return view('page.agent.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  User::withRole();
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
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'qrcode' => $request->qrcode,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $data = User::create($att);
            $data = User::withRole()->find($data->id);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $data = User::withRole()->findOrFail($request->id);

            $data->update([
                'name' => $request->name,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'alamat' => $request->alamat,
                'qrcode' => $request->qrcode,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            if (!empty($request->password))
                $data->update([
                    'password' => Hash::make($request->password),
                ]);
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
