<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Drug;
use Illuminate\Http\Request;
use Exception;

class DrugController extends Controller
{
    //
    public function select2(Request $request)
    {
        try {
            $query = Drug::select('id', 'name', 'satuan');
            if (!empty($request->id)) {
                $query->where('id', $request->id);
            }
            if (!empty($request->searchTerm)) {
                $query->where('name', 'like', '%' . $request->searchTerm . '%');
            }
            $users = $query->limit(20)->get();

            $data = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name,
                    'name' => $user->name,
                    'satuan' => $user->satuan // Ini yang akan ditampilkan di dropdown Select2
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

    public function index(Request $request)

    {
        $dataContent =  [];
        return view('page.drug.index', compact('request', 'dataContent'));
    }

    public function sebaran(Request $request)

    {
        $dataContent =  [];
        return view('page.drug.sebaran', compact('request', 'dataContent'));
    }


    public function get(Request $request)
    {
        try {
            $query =  Drug::query();
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
                'satuan' => $request->satuan,

            ];
            $data = Drug::create($att);
            $data = Drug::find($data->id);

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
            $data = Drug::findOrFail($request->id);

            $data->update([
                'name' => $request->name,
                'satuan' => $request->satuan,
            ]);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Drug::findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
