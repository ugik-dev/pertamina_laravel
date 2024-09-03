<?php

namespace App\Http\Controllers\api;

use App\Events\RequestCallEvent;
use App\Models\RequestCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    //
    public function index()
    {
        return RequestCall::all();
    }


    public function post(Request $request)
    {
        $validate  = $request->validate([
            'ref_emergency_id' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);
        $validate['login_session_id'] = $request->user()->id;
        $res = RequestCall::create($validate);
        $res->id;
        RequestCallEvent::dispatch($res->id, $res->ref_emergency_id, $res->status);

        return response()->json([
            'message' => 'Request Emergency success',
            'data' => [
                'res' => $res
            ]
        ]);
    }

    public function test_call(Request $request)
    {
        // $validate  = $request->validate([
        //     'ref_emergency_id' => 'required',
        //     'long' => 'required',
        //     'lat' => 'required',
        // ]);
        // $validate['login_session_id'] = $request->user()->id;
        // $res = RequestCall::create($validate);
        // $res->id;
        RequestCallEvent::dispatch(1, 1, 1);

        return response()->json([
            'message' => 'Request Emergency success',
            'data' => [
                'res' => ['datatest']
            ]
        ]);
    }
}
