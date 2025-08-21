@extends('layouts.admin.main')

@section('breadcrumb')
<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">
                <i data-lucide="home" class="w-4 h-4 me-2.5"></i>
                Admin
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Dashboard</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="text-sm font-medium text-gray-500">Total Pendapatan (30 Hari)</h4>
            <p class="text-3xl font-bold text-gray-800 mt-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="text-sm font-medium text-gray-500">Total Transaksi (30 Hari)</h4>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalTransactions) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="text-sm font-medium text-gray-500">Karyawan Teratas (30 Hari)</h4>
            <p class="text-xl font-bold text-gray-800 mt-1 truncate">{{ $topEmployee->karyawan->name ?? '-' }}</p>
            <p class="text-sm text-gray-600">Rp {{ number_format($topEmployee->total_pendapatan ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="text-sm font-medium text-gray-500">Toko Teratas (30 Hari)</h4>
            <p class="text-xl font-bold text-gray-800 mt-1 truncate">{{ $topStore->toko->name ?? '-' }}</p>
            <p class="text-sm text-gray-600">Rp {{ number_format($topStore->total_pendapatan ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Main Chart -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Pendapatan (30 Hari Terakhir)</h3>
        <canvas id="dashboardIncomeChart"></canvas>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toko</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Setoran</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($recentActivities as $activity)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Carbon\Carbon::parse($activity->tanggal)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $activity->karyawan->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $activity->toko->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">Rp {{ number_format($activity->jumlah_penjualan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada aktivitas terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('dashboardIncomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dailyIncomeLabels),
                datasets: [{
                    label: 'Pendapatan Harian',
                    data: @json($dailyIncomeValues),
                    backgroundColor: 'rgba(0, 0, 0, 0.05)',
                    borderColor: 'rgba(0, 0, 0, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush