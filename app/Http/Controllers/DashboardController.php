<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function transactions()
    {
        return view('dashboard.transactions.index', [
            'title' => 'Transaksi'
        ]);
    }

    public function order()
    {
        return view('dashboard.order.index', [
            'title' => 'Order'
        ]);
    }
}
