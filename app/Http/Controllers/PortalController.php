<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    //
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.pages.page-portal', ['pageConfigs' => $pageConfigs]);
    }

    public function content()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];

        $contents = Content::orderBy('created_at', 'desc')->paginate(6);

        return view('content.pages.page-contents', compact('pageConfigs', 'contents'));
    }

    public function bank_data()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $contents = Bank::with('owner', 'ref_bank')->get();
        // dd($contents);
        return view('content.pages.page-bank-data', compact('pageConfigs', 'contents'));
    }


    public function home()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $internalUser = User::select('id', 'name')->with('unit')
            ->whereHas('unit', function ($query) {
                $query->where('category', 'internal');
            })
            ->get();

        $results = User::with(['field_work', 'unit' => function ($query) {
            $query->where('category', 'internal');
        }, 'screenings' => function ($query) {
            $query->whereDate('created_at', '2024-09-06')
                ->orderBy('created_at', 'desc');
        }])
            ->get();
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
            'counterInternal' => $countScreening
        ];


        return view('content.pages.page-home', compact('pageConfigs', 'dataContent'));
        return view('content.pages.page-home', compact('pageConfigs', 'dataContent'));
    }
    public function scan_fit()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.pages.page-scanner', ['pageConfigs' => $pageConfigs]);
    }
}
