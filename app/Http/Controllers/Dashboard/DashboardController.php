<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessLayer\DashboardBusinessLayer;

class DashboardController extends Controller
{
    private $dashboardBusinessLayer;

    public function __construct()
    {
        $this->dashboardBusinessLayer = new DashboardBusinessLayer();
    }

    public function dashboardAdmin()
    {
        $params = [
            'title' => 'Dashboard Admin'
        ];

        return view('admin.dashboard.index', $params);
    }


    public function dashboardUser()
    {   
        $params = [
            'title' => 'Dashboard User'
        ];

        return view('shop.dashboard.index', $params);
    }
   
}
