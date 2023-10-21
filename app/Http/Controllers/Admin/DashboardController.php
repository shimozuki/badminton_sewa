<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pemasukan = Transaction::select('amount', 'created_at')->where('is_valid', '1')->get();

        $monthlyRevenue = [];

        foreach ($pemasukan as $data) {
            $created_at = \Carbon\Carbon::parse($data->created_at);
            $month = $created_at->format('F');
            $amount = $data->amount;

            if (!isset($monthlyRevenue[$month])) {
                $monthlyRevenue[$month] = 0;
            }

            $monthlyRevenue[$month] += $amount;
        }

        $labels = array_keys($monthlyRevenue);
        $data = array_values($monthlyRevenue);

        return view('admin.dashboard.index', compact('labels', 'data'));
    }
}
