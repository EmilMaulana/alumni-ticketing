<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard Teknik Rekayasa'
        ]);
    }

    public function transactions()
    {
        return view('dashboard.transactions.index', [
            'title' => 'My Transactions'
        ]);
    }

    public function order()
    {
        return view('dashboard.order.index', [
            'title' => 'My Order'
        ]);
    }
}
