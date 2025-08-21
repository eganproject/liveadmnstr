@extends('layouts.admin.main')

@section('breadcrumb')
<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/admin" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">
                <i data-lucide="home" class="w-4 h-4 me-2.5"></i>
                Admin
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Laporan</span>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Pendapatan</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Laporan Pendapatan Harian</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="report_date_range" class="block text-xs font-medium text-gray-600 mb-1">Filter Tanggal:</label>
                <input type="text" id="report_date_range" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm flatpickr-date-range">
            </div>
            <div class="flex items-end">
                <button id="generate_report" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">Generate Laporan</button>
            </div>
        </div>

        <div id="report_results" class="mt-6">
            <h4 class="text-md font-semibold text-gray-700 mb-3">Ringkasan Laporan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Pendapatan:</p>
                    <p class="text-lg font-bold text-gray-800" id="total_income">Rp. 0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Jumlah Live Streaming:</p>
                    <p class="text-lg font-bold text-gray-800" id="total_livestreaming">0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Like:</p>
                    <p class="text-lg font-bold text-gray-800" id="total_likes">0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Komentar:</p>
                    <p class="text-lg font-bold text-gray-800" id="total_comments">0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Ditonton:</p>
                    <p class="text-lg font-bold text-gray-800" id="total_views">0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Rata-rata Pendapatan Harian:</p>
                    <p class="text-lg font-bold text-gray-800" id="avg_daily_income">Rp. 0</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Pendapatan Karyawan Terbesar:</p>
                    <p class="text-lg font-bold text-gray-800" id="top_employee_income">Rp. 0 (Nama Karyawan)</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Pendapatan Toko Terbesar:</p>
                    <p class="text-lg font-bold text-gray-800" id="top_store_income">Rp. 0 (Nama Toko)</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Pendapatan Sesi Terbesar:</p>
                    <p class="text-lg font-bold text-gray-800" id="top_session_income">Rp. 0 (Sesi)</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Rata-rata Pendapatan per Karyawan:</p>
                    <p class="text-lg font-bold text-gray-800" id="avg_employee_income">Rp. 0</p>
                </div>
            </div>

            <h4 class="text-md font-semibold text-gray-700 mt-6 mb-3">Grafik Pendapatan Harian</h4>
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <canvas id="dailyIncomeChart"></canvas>
            </div>

            <h4 class="text-md font-semibold text-gray-700 mt-6 mb-3">Pendapatan per Karyawan</h4>
            <div class="overflow-x-auto bg-gray-50 p-4 rounded-lg shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karyawan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody id="income_per_employee_body" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <h4 class="text-md font-semibold text-gray-700 mt-6 mb-3">Pendapatan per Toko</h4>
            <div class="overflow-x-auto bg-gray-50 p-4 rounded-lg shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toko</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody id="income_per_store_body" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        let dailyIncomeChart = null;

        // Flatpickr for date range
        flatpickr("#report_date_range", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: [new Date().setDate(new Date().getDate() - 6), new Date()]
        });

        function fetchReportData() {
            var dateRange = $('#report_date_range').val();
            var dates = dateRange.split(' to ');
            var startDate = dates[0];
            var endDate = dates.length > 1 ? dates[1] : dates[0];

            $.ajax({
                url: '{{ route("admin.reports.pendapatan.index") }}',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    // Update summary cards
                    $('#total_income').text(response.total_income);
                    $('#total_livestreaming').text(response.total_transactions);
                    $('#total_likes').text(response.total_likes);
                    $('#total_comments').text(response.total_comments);
                    $('#total_views').text(response.total_views);
                    $('#avg_daily_income').text(response.avg_daily_income);
                    $('#top_employee_income').text(response.top_employee_income);
                    $('#top_store_income').text(response.top_store_income);
                    $('#top_session_income').text(response.top_session_income);
                    $('#avg_employee_income').text(response.avg_employee_income);

                    // Update Daily Income Chart
                    if (dailyIncomeChart) {
                        dailyIncomeChart.destroy();
                    }
                    const ctx = document.getElementById('dailyIncomeChart').getContext('2d');
                    dailyIncomeChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: response.daily_income_labels,
                            datasets: [{
                                label: 'Total Pendapatan Harian',
                                data: response.daily_income_values,
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

                    // Update income per employee table
                    var employeeTableBody = $('#income_per_employee_body');
                    employeeTableBody.empty();
                    if (response.income_per_employee.length > 0) {
                        $.each(response.income_per_employee, function(index, item) {
                            var row = '<tr>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + item.karyawan_name + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + item.total_income + '</td>' +
                                '</tr>';
                            employeeTableBody.append(row);
                        });
                    } else {
                        employeeTableBody.append('<tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>');
                    }

                    // Update income per store table
                    var storeTableBody = $('#income_per_store_body');
                    storeTableBody.empty();
                    if (response.income_per_store.length > 0) {
                        $.each(response.income_per_store, function(index, item) {
                            var row = '<tr>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + item.toko_name + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + item.total_income + '</td>' +
                                '</tr>';
                            storeTableBody.append(row);
                        });
                    } else {
                        storeTableBody.append('<tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching report data:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Tidak dapat memuat data laporan.',
                    });
                }
            });
        }

        // Initial report load
        fetchReportData();

        // Generate report button click
        $('#generate_report').on('click', function() {
            fetchReportData();
        });
    });
</script>
@endpush
