<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\PendapatanHarian;
use App\Models\Karyawan;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = PendapatanHarian::query();

            if ($startDate && $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }

            // 1. Rata-rata pendapatan harian (summary)
            $avgDailyIncome = $query->clone()
                                    ->select(DB::raw('AVG(jumlah_penjualan) as average_income'))
                                    ->groupBy('tanggal')
                                    ->pluck('average_income')
                                    ->avg();
            $avgDailyIncome = 'Rp. ' . number_format($avgDailyIncome, 0, ',', '.');

            // 2. Pendapatan karyawan terbesar selama periode filter
            $topEmployeeIncome = $query->clone()
                                       ->select('karyawan_id', DB::raw('SUM(jumlah_penjualan) as total_income'))
                                       ->groupBy('karyawan_id')
                                       ->orderByDesc('total_income')
                                       ->with('karyawan')
                                       ->first();
            $topEmployeeIncomeFormatted = 'Rp. 0 (Tidak ada data)';
            if ($topEmployeeIncome) {
                $topEmployeeIncomeFormatted = 'Rp. ' . number_format($topEmployeeIncome->total_income, 0, ',', '.') . ' (' . $topEmployeeIncome->karyawan->name . ')';
            }

            // 3. Pendapatan toko terbesar
            $topStoreIncome = $query->clone()
                                    ->select('toko_id', DB::raw('SUM(jumlah_penjualan) as total_income'))
                                    ->groupBy('toko_id')
                                    ->orderByDesc('total_income')
                                    ->with('toko')
                                    ->first();
            $topStoreIncomeFormatted = 'Rp. 0 (Tidak ada data)';
            if ($topStoreIncome) {
                $topStoreIncomeFormatted = 'Rp. ' . number_format($topStoreIncome->total_income, 0, ',', '.') . ' (' . $topStoreIncome->toko->name . ')';
            }

            // 4. Pendapatan sesi terbesar
            $topSessionIncome = $query->clone()
                                      ->select('sesi', DB::raw('SUM(jumlah_penjualan) as total_income'))
                                      ->groupBy('sesi')
                                      ->orderByDesc('total_income')
                                      ->first();
            $topSessionIncomeFormatted = 'Rp. 0 (Tidak ada data)';
            if ($topSessionIncome) {
                $topSessionIncomeFormatted = 'Rp. ' . number_format($topSessionIncome->total_income, 0, ',', '.') . ' (Sesi ' . $topSessionIncome->sesi . ')';
            }

            // 5. Rata-rata pendapatan per karyawan (summary)
            $avgEmployeeIncome = $query->clone()
                                       ->select(DB::raw('SUM(jumlah_penjualan) as total_income'))
                                       ->groupBy('karyawan_id')
                                       ->pluck('total_income')
                                       ->avg();
            $avgEmployeeIncomeFormatted = 'Rp. ' . number_format($avgEmployeeIncome, 0, ',', '.');

            // List of income per employee (for table and chart)
            $incomePerEmployeeData = $query->clone()
                                       ->select(
                                           'karyawan_id',
                                           DB::raw('SUM(jumlah_penjualan) as total_income'),
                                           DB::raw('COUNT(DISTINCT tanggal) as total_days_active')
                                       )
                                       ->groupBy('karyawan_id')
                                       ->with('karyawan')
                                       ->get();

            $incomePerEmployee = $incomePerEmployeeData->map(function($item) {
                                           $avgDaily = $item->total_days_active > 0 ? $item->total_income / $item->total_days_active : 0;
                                           return [
                                               'karyawan_name' => $item->karyawan->name,
                                               'total_income' => 'Rp. ' . number_format($item->total_income, 0, ',', '.'),
                                               'avg_daily_income' => 'Rp. ' . number_format($avgDaily, 0, ',', '.'),
                                           ];
                                       });

            $employeeChartLabels = $incomePerEmployeeData->pluck('karyawan.name')->toArray();
            $employeeChartData = $incomePerEmployeeData->pluck('total_income')->toArray();


            // List of income per store (for table and chart)
            $incomePerStoreData = $query->clone()
                                    ->select(
                                        'toko_id',
                                        DB::raw('SUM(jumlah_penjualan) as total_income'),
                                        DB::raw('COUNT(DISTINCT tanggal) as total_days_active')
                                    )
                                    ->groupBy('toko_id')
                                    ->with('toko')
                                    ->get();

            $incomePerStore = $incomePerStoreData->map(function($item) {
                                        $avgDaily = $item->total_days_active > 0 ? $item->total_income / $item->total_days_active : 0;
                                        return [
                                            'toko_name' => $item->toko->name,
                                            'total_income' => 'Rp. ' . number_format($item->total_income, 0, ',', '.'),
                                            'avg_daily_income' => 'Rp. ' . number_format($avgDaily, 0, ',', '.'),
                                        ];
                                    });

            $storeChartLabels = $incomePerStoreData->pluck('toko.name')->toArray();
            $storeChartData = $incomePerStoreData->pluck('total_income')->toArray();


            // Daily Income for Line Chart
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
                $dailyIncomeLabels[] = $formattedDate;
                $dailyIncomeValues[] = $dailyIncomeData->get($formattedDate)->total_daily_income ?? 0;
            }

            // Session Income for Bar Chart
            $sessionIncomeData = $query->clone()
                                       ->select('sesi', DB::raw('SUM(jumlah_penjualan) as total_session_income'))
                                       ->groupBy('sesi')
                                       ->orderBy('sesi')
                                       ->get();

            $sessionChartLabels = $sessionIncomeData->pluck('sesi')->map(function($sesi) { return 'Sesi ' . $sesi; })->toArray();
            $sessionChartData = $sessionIncomeData->pluck('total_session_income')->toArray();


            // Other Metrics
            $totalIncome = $query->clone()->sum('jumlah_penjualan');
            $totalIncomeFormatted = 'Rp. ' . number_format($totalIncome, 0, ',', '.');

            $totalLikes = $query->clone()->sum('jumlah_like');
            $totalComments = $query->clone()->sum('jumlah_komentar');
            $totalViews = $query->clone()->sum('jumlah_ditonton');
            $totalTransactions = $query->clone()->count(); // Reverted to totalTransactions

            return response()->json([
                'avg_daily_income' => $avgDailyIncome,
                'top_employee_income' => $topEmployeeIncomeFormatted,
                'top_store_income' => $topStoreIncomeFormatted,
                'top_session_income' => $topSessionIncomeFormatted,
                'avg_employee_income' => $avgEmployeeIncomeFormatted,
                'income_per_employee' => $incomePerEmployee,
                'income_per_store' => $incomePerStore,
                'total_income' => $totalIncomeFormatted,
                'total_likes' => $totalLikes,
                'total_comments' => $totalComments,
                'total_views' => $totalViews,
                'total_transactions' => $totalTransactions, // Reverted key

                // Chart Data
                'daily_income_labels' => $dailyIncomeLabels,
                'daily_income_values' => $dailyIncomeValues,
                'employee_chart_labels' => $employeeChartLabels,
                'employee_chart_data' => $employeeChartData,
                'store_chart_labels' => $storeChartLabels,
                'store_chart_data' => $storeChartData,
                'session_chart_labels' => $sessionChartLabels,
                'session_chart_data' => $sessionChartData,
            ]);

        }

        // For initial page load, return the view
        return view('admin.reports.pendapatan.index');
    }
}