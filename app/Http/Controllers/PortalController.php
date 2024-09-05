<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    //
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.pages.page-portal', ['pageConfigs' => $pageConfigs]);
    }

    public function scan_fit()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.pages.page-scanner', ['pageConfigs' => $pageConfigs]);
    }
}
