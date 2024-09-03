<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginBasic extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect('/dashboard');
    }
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }



  public function login(Request $request)
  {
    $credentials = $request->only('username', 'password');
    $user = User::select('users.*', 'roles.title as title_role')
      ->join('roles', 'users.role_id', '=', 'roles.id')
      ->where('users.username', $credentials['username'])
      ->first();
    if ($user && Hash::check($credentials['password'], $user->password)) {
      Auth::login($user);
      return $this->responseSuccess(['success', 'data' => Auth::user()]);
    }

    $user = User::where('username', $credentials['username'])->first();

    if (!$user) {
      return  $this->responseError("Username tidak ditemukan");
    }
    if (!Hash::check($credentials['password'], $user->password)) {
      return  $this->responseError("Password salah");
    }

    return  $this->responseError("Gagal melakukan autentikasi");
  }

  public function logout()
  {
    Auth::logout();

    return redirect('/'); // Redirect to the desired page after logout
  }
}
