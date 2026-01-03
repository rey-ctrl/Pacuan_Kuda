<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Keuangan - Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

<section class="flex min-h-screen">

<!-- Sidebar Fixed -->
<aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between z-50">
    <div>
        <h2 class="text-lg font-semibold text-green-900 mb-6 px-4">Admin Panel</h2>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-600 font-semibold' : '' }}">
                Dashboard Keuangan
            </a>
            <a href="{{ route('admin.data_keuangan') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.data_keuangan') ? 'bg-teal-600 text-white font-semibold' : 'text-gray-700 hover:bg-teal-50 hover:text-teal-600' }} transition">
                Data Keuangan
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                Manajemen Galeri
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                Manajemen Artikel
            </a>
        </nav>
    </div>
    
    <div class="pt-4 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                <i class="fa fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-64 p-6 md:p-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Data Pendaftar & Keuangan</h1>
    </div>

    <!-- Pesan Status -->
    @if(session('status'))
    <div class="mb-6 p-4 bg-teal-50 border-l-4 border-teal-500 text-teal-700 shadow-sm flex justify-between items-center">
        <span><i class="fa fa-check-circle mr-2"></i> {{ session('status') }}</span>
        <button onclick="this.parentElement.remove()" class="text-teal-900 font-bold">&times;</button>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase font-bold text-xs border-b">
                    <tr>
                        <th class="px-4 py-4">No</th>
                        <th class="px-4 py-4">Nama Lengkap</th>
                        <th class="px-4 py-4 text-center">Program & Trainer</th>
                        <th class="px-4 py-4">Pembayaran</th>
                        <th class="px-4 py-4">Nominal</th>
                        <th class="px-4 py-4 text-center">Bukti</th>
                        <th class="px-4 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pendaftaran as $index => $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 font-medium">{{ $index + 1 }}</td>
                            <td class="px-4 py-4">
                                <div class="font-bold text-gray-800">{{ $row->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500">{{ $row->nomor_wa }}</div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2 py-1 bg-teal-50 text-teal-700 rounded text-[10px] font-bold uppercase">{{ $row->program_latihan }}</span>
                                <div class="text-xs mt-1 text-gray-600">{{ $row->trainer }}</div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-gray-700 font-medium">{{ $row->metode_pembayaran }}</div>
                                <div class="text-[10px] text-gray-400">{{ $row->tgl_pendaftaran }}</div>
                            </td>
                            <td class="px-4 py-4 font-bold text-teal-700">
                                @if ($row->nominal)
                                    Rp {{ number_format($row->nominal, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if ($row->bukti_pembayaran_path && $row->bukti_pembayaran_path != 'Tidak Ada Bukti')
                                    <a href="{{ asset($row->bukti_pembayaran_path) }}" target="_blank" class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition text-xs">
                                        <i class="fa fa-image mr-1"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.pendaftaran.edit', $row->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition" title="Edit Data">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.pendaftaran.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition" title="Hapus Data">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-20 text-gray-400 italic">
                                <i class="fa fa-folder-open text-4xl mb-3 block"></i>
                                Belum ada data pendaftaran masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>


</section>
</body>
</html>