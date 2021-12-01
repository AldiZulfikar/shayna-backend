<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $income = Transaction::where('status', 'SUCCESS')->sum('transaction_total');
        $sales = Transaction::count();
        $items = Transaction::orderBy('id', 'DESC')->take(5)->get();
        $pie = [
            'pending' => Transaction::where('status', 'PENDING')->count(),
            'failed' => Transaction::where('status', 'FAILED')->count(),
            'sukses' => Transaction::where('status', 'SUCCESS')->count()
        ];

        return view('pages.dashboard', compact([
            'income',
            'sales',
            'items',
            'pie',
        ]));
    }
}
