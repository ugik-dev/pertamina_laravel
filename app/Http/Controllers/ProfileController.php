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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('page.profile.index', compact('request', 'dataContent'));
    }

    public function change_password(Request $request)
    {
        return view('page.profile.change-password');
    }

    public function change_password_process(Request $request)
    {
        try {

            $credentials = $request->only('re_password', 'new_password', 'old_password');
            $user = User::find(Auth::user()->id);
            // dd($credentials, $user);
            if ($user && Hash::check($credentials['old_password'], $user->password)) {
                // Auth::login($user);
                if (($credentials['new_password'] == $credentials['re_password'])) {
                    if (!empty($credentials['new_password'])) {
                        $user->password = Hash::make($credentials['new_password']);
                        $user->save();
                    } else {
                        throw new \Exception("Password tidak boleh kosong!");
                    }
                } else {
                    throw new \Exception("Password tidak sama!");
                }
                // return $this->responseSuccess(['success', 'data' => Auth::user()]);
            } else {
                throw new \Exception("Password lama salah!");
            }
            return $this->responseSuccess("Berhasil");
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
