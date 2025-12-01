<?php
// Catatan: Di Laravel, koneksi database sudah ditangani oleh Eloquent di Controller,
// sehingga tidak ada lagi include '../connect.php'; di sini.
// Variabel $pendaftaran sudah tersedia dari Controller.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keuangan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<section class="flex">

    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-semibold text-green-900 mb-6">Admin Panel</h2>
            <nav class="space-y-2">
                {{-- Gunakan route() untuk link yang benar di Laravel --}}
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Dashboard Keuangan
                </a>
                <a href="{{ url('/admin/data-keuangan') }}" class="block px-4 py-2 rounded-lg text-white bg-teal-600 font-semibold transition">
                    Data Keuangan
                </a>
                <a href="{{ url('/admin/galeri') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Manajemen Galeri
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10 overflow-y-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Pendaftar & Keuangan</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full border border-gray-200 rounded-xl">
                <thead class="bg-teal-600 text-white text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left">Nomor WA</th>
                        <th class="px-4 py-3 text-left">Tempat Tinggal</th>
                        <th class="px-4 py-3 text-left">Jadwal</th>
                        <th class="px-4 py-3 text-left">Trainer</th>
                        <th class="px-4 py-3 text-left">Program Latihan</th>
                        <th class="px-4 py-3 text-left">Kategori Anggota</th>
                        <th class="px-4 py-3 text-left">Metode Pembayaran</th>
                        <th class="px-4 py-3 text-left">Nominal</th>
                        <th class="px-4 py-3 text-left">Bukti Pembayaran</th>
                        <th class="px-4 py-3 text-left">Tanggal Pendaftaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    {{-- Menggunakan @forelse untuk perulangan data dari Controller --}}
                    @forelse ($pendaftaran as $index => $row)
                        <tr class="hover:bg-gray-50">
                            {{-- Menggantikan $no++ dengan $index + 1 --}}
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            {{-- Sintaks {{ }} otomatis melakukan escaping HTML (seperti htmlspecialchars) --}}
                            <td class="px-4 py-3">{{ $row->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $row->nomor_wa }}</td>
                            <td class="px-4 py-3">{{ $row->tempat_tinggal }}</td>
                            <td class="px-4 py-3">{{ $row->jadwal_latihan }}</td>
                            <td class="px-4 py-3">{{ $row->trainer }}</td>
                            <td class="px-4 py-3">{{ $row->program_latihan }}</td>
                            <td class="px-4 py-3">{{ $row->kategori_anggota }}</td>
                            <td class="px-4 py-3">{{ $row->metode_pembayaran }}</td>
                            <td class="px-4 py-3">
                                @if ($row->nominal)
                                    Rp {{ number_format($row->nominal, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($row->bukti_pembayaran_path && $row->bukti_pembayaran_path != 'Tidak Ada Bukti')
                                    {{-- Sesuaikan base URL dengan folder public Laravel Anda --}}
                                    <a href="{{ url($row->bukti_pembayaran_path) }}" target="_blank" class="text-teal-600 underline hover:text-teal-800">Lihat</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $row->tgl_pendaftaran }}</td>
                        </tr>
                    @empty
                        {{-- Akan dijalankan jika $pendaftaran kosong --}}
                        <tr><td colspan="12" class="text-center py-4 text-gray-500">Belum ada data pendaftaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</section>
</body>
</html>