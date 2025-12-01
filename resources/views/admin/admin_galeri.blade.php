<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Galeri - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .thumb { width: 90px; height: 90px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-semibold text-green-900 mb-6">Admin Panel</h2>
            <nav class="space-y-2">
                {{-- Gunakan route() untuk navigasi --}}
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Dashboard Keuangan
                </a>
                <a href="{{ url('/admin/data-keuangan') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Data Keuangan
                </a>
                <a href="{{ url('/admin/galeri') }}" class="block px-4 py-2 rounded-lg text-white bg-teal-600 font-semibold transition">
                    Manajemen Galeri
                </a>
            </nav>
        </div>
    </aside>

    <main class="ml-72 flex-1 p-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-green-700 mb-6 border-b pb-3">Manajemen Galeri</h1>

            @if (isset($status) || isset($msg))
                <div class="mb-5 p-3 rounded-md 
                    @if (isset($status) && $status === 'added') bg-green-100 text-green-700 border border-green-300
                    @elseif (isset($status) && $status === 'deleted') bg-yellow-100 text-yellow-700 border border-yellow-300
                    @else bg-red-100 text-red-700 border border-red-300
                    @endif">
                    @if (isset($status) && $status === 'added') 
                        Foto berhasil ditambahkan.
                    @elseif (isset($status) && $status === 'deleted') 
                        Foto berhasil dihapus.
                    @elseif (isset($msg)) 
                        ⚠️ {{ $msg }}
                    @endif
                </div>
            @endif

            <div class="mb-8 border p-5 rounded-xl bg-green-50">
                <h2 class="text-xl font-semibold text-green-700 mb-4">Tambah Foto Baru</h2>
                {{-- Arahkan ke rute store dengan method POST --}}
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf {{-- Token keamanan wajib di Laravel --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Foto</label>
                        {{-- Tampilkan error validasi Laravel --}}
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <input type="file" name="foto" class="block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="block w-full border border-gray-300 rounded-md p-2">{{ old('deskripsi') }}</textarea>
                    </div>
                    <button type="submit" name="tambah_gambar" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                        Upload Foto
                    </button>
                </form>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 mb-3">Daftar Galeri</h2>
            <div class="overflow-x-auto border rounded-lg">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Gambar</th>
                            <th class="px-6 py-3 text-left font-semibold">Deskripsi</th>
                            <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Menggunakan @forelse untuk perulangan data --}}
                        @forelse ($galeri as $row)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $row->id }}</td>
                                <td class="px-6 py-3">
                                    {{-- Menggunakan asset() untuk path gambar --}}
                                    <img src="{{ asset($row->path_gambar) }}" alt="Gambar" class="thumb">
                                </td>
                                <td class="px-6 py-3">{{ $row->deskripsi ?: '-' }}</td>
                                <td class="px-6 py-3">
                                    {{-- Arahkan ke rute destroy dengan ID gambar --}}
                                    <a href="{{ route('admin.galeri.destroy', $row->id) }}" 
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                        class="text-red-600 hover:text-red-800">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">Belum ada foto.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>