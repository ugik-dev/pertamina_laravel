<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Faskes;
use App\Models\RefEmergency;
use App\Models\RefJenFaskes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refFaskes' => RefJenFaskes::get(),
            'refEmergency' => RefEmergency::get()
        ];
        return view('page.faskes.index', compact('request', 'dataContent'));
    }

    public function sebaran(Request $request)

    {
        $dataContent =  [
            'refFaskes' => RefJenFaskes::get(),
            'refEmergency' => RefEmergency::get()
        ];
        return view('page.faskes.sebaran', compact('request', 'dataContent'));
    }


    public function get(Request $request)
    {
        try {
            $query =  Faskes::with('jen_faskes');
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
                'alamat' => $request->alamat,
                'ref_jen_faskes_id' => $request->ref_jen_faskes_id,
                'description' => $request->description,
                'website' => $request->website,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'user_id' => $request->user_id,
                'long' => $request->long,
                'lat' => $request->lat,
                'operasional_time' => $request->operasional_time,
            ];
            $data = Faskes::create($att);
            $data = Faskes::with('jen_faskes')->find($data->id);

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
            $data = Faskes::with('jen_faskes')->findOrFail($request->id);

            $data->update([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'description' => $request->description,
                'ref_jen_faskes_id' => $request->ref_jen_faskes_id,
                'website' => $request->website,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'user_id' => $request->user_id,
                'long' => $request->long,
                'lat' => $request->lat,
                'operasional_time' => $request->operasional_time,
            ]);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Faskes::with('jen_faskes')->findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
