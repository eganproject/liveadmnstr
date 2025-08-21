<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendapatanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
        // Default date range: last 30 days
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(29);

        // Base query for the date range
        $query = PendapatanHarian::whereBetween('tanggal', [$startDate, $endDate]);

        // 1. Total Income
        $totalIncome = $query->clone()->sum('jumlah_penjualan');

        // 2. Total Transactions (Live Streams)
        $totalTransactions = $query->clone()->count();

        // 3. Top Employee
        $topEmployee = $query->clone()
            ->select('karyawan_id', DB::raw('SUM(jumlah_penjualan) as total_pendapatan'))
            ->groupBy('karyawan_id')
            ->orderByDesc('total_pendapatan')
            ->with('karyawan')
            ->first();

        // 4. Top Store
        $topStore = $query->clone()
            ->select('toko_id', DB::raw('SUM(jumlah_penjualan) as total_pendapatan'))
            ->groupBy('toko_id')
            ->orderByDesc('total_pendapatan')
            ->with('toko')
            ->first();

        // 5. Recent Activities (last 5 entries)
        $recentActivities = PendapatanHarian::with(['karyawan', 'toko'])
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // 6. Daily Income Chart Data (for the last 30 days)
        $dailyIncomeData = $query->clone()
            ->select(DB::raw('DATE(tanggal) as date'), DB::raw('SUM(jumlah_penjualan) as total_daily_income'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $period = CarbonPeriod::create($startDate, $endDate);
        $dailyIncomeLabels = [];
        $dailyIncomeValues = [];

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dailyIncomeLabels[] = $date->format('d M'); // Format for display
            $dailyIncomeValues[] = $dailyIncomeData->get($formattedDate)->total_daily_income ?? 0;
        }

        return view('admin.dashboard.index', compact(
            'totalIncome',
            'totalTransactions',
            'topEmployee',
            'topStore',
            'recentActivities',
            'dailyIncomeLabels',
            'dailyIncomeValues'
        ));
    }
}
