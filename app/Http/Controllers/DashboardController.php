<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $pageConfigs = ['myLayout' => 'vertical'];
        $internalUser = User::select('id', 'name')->with('unit')
            ->whereHas('unit', function ($query) {
                $query->where('category', 'internal');
            })
            ->get();

        $results = User::whereHas('unit', function ($query) {
            // $query->where('category', 'internal');
        })->with(['field_work', 'unit', 'screenings' => function ($query) {
            // $query->whereDate('created_at', '2024-09-06')
            $query->whereDate('created_at', Carbon::today())
                ->orderBy('created_at', 'desc');
        }])->get();

        $external  = User::whereHas('unit', function ($query) {
            $query->where('category', 'external');
        })->whereHas('screenings', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->with(['field_work', 'unit', 'screenings' => function ($query) {
            $query->whereDate('created_at', Carbon::today())
                ->orderBy('created_at', 'desc');
        }])->get();
        $countFitalityY = 0;
        $countFitalityN = 0;
        $countNoScreening = 0;

        // Proses data hasil
        foreach ($results as $user) {
            if ($user->screenings->isNotEmpty()) {
                // Ambil screening terakhir
                $latestScreening = $user->screenings->first();

                if ($latestScreening->fitality === 'Y') {
                    $countFitalityY++;
                } elseif ($latestScreening->fitality === 'N') {
                    $countFitalityN++;
                }
            } else {
                $countNoScreening++;
            }
        }

        $countScreening = [
            'fit' => $countFitalityY,
            'unfit' => $countFitalityN,
            'nul' => $countNoScreening,
            'total' => $internalUser->count(),
        ];
        $dataContent = [
            'content' => Content::orderBy('created_at', 'desc')->limit(2)->get(),
            'internalUser' => $results,
            'counterInternal' => $countScreening,
            'external' => $external
        ];


        return view('content.pages.page-home', compact('pageConfigs', 'dataContent'));
    }
}
