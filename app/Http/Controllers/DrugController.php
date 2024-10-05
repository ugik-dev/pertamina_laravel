<?php

namespace App\Http\Controllers;

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
}
