<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Guarantor;
use App\Models\RefEmergency;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        return view('page.manage.guarantor', compact('request'));
    }

    public function get(Request $request)
    {
        try {
            $query =  Guarantor::query();
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->get()->toArray();
            $data =   DataStructure::keyValueObj($res, 'id', NULL, TRUE);
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
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'category' => $request->category,
            ];
            $data = Guarantor::create($att);
            $data = Guarantor::find($data->id);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        try {
            $data = Guarantor::findOrFail($request->id);

            $data->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'category' => $request->category,

            ]);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Guarantor::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
