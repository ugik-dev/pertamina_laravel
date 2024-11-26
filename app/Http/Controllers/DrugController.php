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
            $query = Drug::select('id', 'nama_obat', 'kode_oss', 'zat_aktif_utama');
            if (!empty($request->id)) {
                $query->where('id', $request->id);
            }
            if (!empty($request->searchTerm)) {
                // $query->where('name', 'like', '%' . $request->searchTerm . '%');
                $query->where(function ($q) use ($request) {
                    $q->where('nama_obat', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('kelas', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('sub_kelas', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('pabrik', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('zat_aktif_utama', 'like', '%' . $request->searchTerm . '%');
                });
            }
            $users = $query->limit(20)->get();

            $data = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->nama_obat . '|' . $user->kode_oss . "|" . $user->zat_aktif_utama,
                    'name' => $user->nama_obat,
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
                'name' => $request->nama_obat,
                'satuan' => $request->dosis,
                'kode_oss' => $request->kode_oss,
                'kelas' => $request->kelas,
                'sub_kelas' => $request->sub_kelas,
                'nama_obat' => $request->nama_obat,
                'pabrik' => $request->pabrik,
                'pbf' => $request->pbf,
                'zat_aktif_utama' => $request->zat_aktif_utama,
                'zat_aktif_lain' => $request->zat_aktif_lain,
                'sediaan' => $request->sediaan,
                'isi_perkemasan' => $request->isi_perkemasan,
                'dosis' => $request->dosis,
                'hna_per_kemasan' => $request->hna_per_kemasan,
                'hna_satuan' => $request->hna_satuan,
                'disc' => $request->disc,
                'harga_beli_satuan' => $request->harga_beli_satuan,
                'harga_beli_kemasan' => $request->harga_beli_kemasan,
                'golongan' => $request->golongan,
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
                'name' => $request->nama_obat,
                'satuan' => $request->dosis,
                'kode_oss' => $request->kode_oss,
                'kelas' => $request->kelas,
                'sub_kelas' => $request->sub_kelas,
                'nama_obat' => $request->nama_obat,
                'pabrik' => $request->pabrik,
                'pbf' => $request->pbf,
                'zat_aktif_utama' => $request->zat_aktif_utama,
                'zat_aktif_lain' => $request->zat_aktif_lain,
                'sediaan' => $request->sediaan,
                'isi_perkemasan' => $request->isi_perkemasan,
                'dosis' => $request->dosis,
                'hna_per_kemasan' => $request->hna_per_kemasan,
                'hna_satuan' => $request->hna_satuan,
                'disc' => $request->disc,
                'harga_beli_satuan' => $request->harga_beli_satuan,
                'harga_beli_kemasan' => $request->harga_beli_kemasan,
                'golongan' => $request->golongan,
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
