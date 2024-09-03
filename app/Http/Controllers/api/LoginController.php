<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LiveLocation;
use App\Models\LoginSession;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        $user = LoginSession::create($validated)->id;
        $user = LoginSession::find($user);

        return response()->json([
            'message' => 'Authentication success',
            'data' => [
                'token' => $user->createToken('api-token')->plainTextToken,
                'name' => $user->name,
                'phone' => $user->phone
            ]
        ]);
    }

    public function loginLiveLocation(Request $request)
    {
        try {

            $credentials = $request->only('id_login', 'key_login');
            $data = LiveLocation::select('ref_live_locations.name as name_jenis', 'live_locations.*')
                ->join('ref_live_locations', 'ref_live_locations.id', '=', 'live_locations.ref_live_location_id')
                ->where('live_locations.id_login', $credentials['id_login'])
                ->first();

            if ($data && Hash::check($credentials['key_login'], $data->key_login)) {
                $data['token'] =  $data->createToken('api-token')->plainTextToken;

                return $this->responseSuccess($data);
            }

            $data = LiveLocation::where('id_login', $credentials['id_login'])->first();

            if (!$data) {
                return  $this->responseError("ID tidak ditemukan", 400);
                dd($credentials);
            }
            if (!Hash::check($credentials['key_login'], $data->key_login)) {
                return  $this->responseError("KEY salah", 400);
            }

            return  $this->responseError("Gagal melakukan autentikasi", 400);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
