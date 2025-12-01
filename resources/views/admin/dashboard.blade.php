<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<section class="flex min-h-screen">

    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-semibold text-green-900 mb-6">Admin Panel</h2>
            <nav class="space-y-2">
                {{-- Gunakan route() untuk navigasi --}}
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded-lg text-white bg-teal-600 font-semibold transition">
                    Dashboard Keuangan
                </a>
                <a href="{{ url('/admin/data-keuangan') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Data Keuangan
                </a>
                <a href="{{ url('/admin/admin-galeri') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Manajemen Galeri
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-8 ml-64">

        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Keuangan</h1>
                <p class="text-gray-500 text-sm">Pantau pendaftaran dan pemasukan latihan kuda setiap saat</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                <div class="w-10 h-10 rounded-full bg-gray-200"></div>
            </div>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow text-center border-l-4 border-teal-600">
                <p class="text-gray-500 text-sm mb-1">Total Pendaftar</p>
                {{-- Menggunakan variabel dari Controller --}}
                <h2 class="text-4xl font-extrabold text-teal-700">{{ $total_pendaftar }}</h2>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center border-l-4 border-green-600">
                <p class="text-gray-500 text-sm mb-1">Total Pemasukan</p>
                {{-- Menggunakan helper number_format --}}
                <h2 class="text-4xl font-extrabold text-green-700">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</h2>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center border-l-4 border-blue-600">
                <p class="text-gray-500 text-sm mb-1">Rata-rata Pembayaran</p>
                <h2 class="text-4xl font-extrabold text-blue-700">
                    {{-- Menghitung rata-rata dan menggunakan helper number_format --}}
                    Rp {{ number_format($rata_rata_pembayaran, 0, ',', '.') }}
                </h2>
            </div>
        </section>

        <section class="bg-white p-6 rounded-xl shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Pemasukan Per Bulan</h3>
                <p class="text-sm text-gray-500">Periode: Tahun {{ date('Y') }}</p>
            </div>

            <canvas id="chartBulanan" class="w-full h-64"></canvas>
        </section>

    </main>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartBulanan').getContext('2d');
    const chartBulanan = new Chart(ctx, {
        type: 'bar',
        data: {
            // Menggunakan sintaks Blade untuk data dari Controller
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                label: 'Total Pemasukan (Rp)',
                data: {!! json_encode($nominal) !!},
                backgroundColor: 'rgba(13, 148, 136, 0.8)',
                borderRadius: 6,
                borderWidth: 1,
                borderColor: 'rgba(13, 148, 136, 1)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            // Fungsi format Rupiah di sisi klien (JS)
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        color: '#4b5563'
                    },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: { color: '#4b5563' },
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>