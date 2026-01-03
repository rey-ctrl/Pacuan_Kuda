<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Artikel - Bimalukarstable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar Fixed -->
        <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between z-50">
            <div>
                <h2 class="text-lg font-semibold text-green-900 mb-6">Admin Panel</h2>
                <nav class="space-y-2">
                    {{-- Navigasi sesuai permintaan user --}}
                    <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition {{ request()->is('admin/dashboard') ? 'bg-teal-50 text-teal-600 font-semibold' : '' }}">
                        Dashboard Keuangan
                    </a>
                    <a href="{{ url('/admin/data-keuangan') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition {{ request()->is('admin/data-keuangan') ? 'bg-teal-50 text-teal-600 font-semibold' : '' }}">
                        Data Keuangan
                    </a>
                    <a href="{{ url('/admin/galeri') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition {{ request()->is('admin/galeri') ? 'bg-teal-600 text-white font-semibold' : '' }}">
                        Manajemen Galeri
                    </a>
                    {{-- Menu Manajemen Artikel (Aktif di halaman ini) --}}
                    <a href="{{ route('admin.artikel.index') }}" class="block px-4 py-2 rounded-lg bg-teal-600 text-white font-semibold transition">
                        Manajemen Artikel
                    </a>
                </nav>
            </div>
            
            <!-- Tambahan Logout di bawah jika diperlukan -->
            <div class="pt-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                        <i class="fa fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content (Ditambah margin left agar tidak tertutup sidebar fixed) -->
        <main class="flex-1 ml-64 p-6 md:p-10">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Artikel</h1>
            </div>

            <!-- Pesan Status -->
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm flex justify-between items-center">
                <span><i class="fa fa-check-circle mr-2"></i> {{ session('status') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-900 font-bold">&times;</button>
            </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Form Tambah Artikel -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h2 class="text-lg font-semibold mb-4 text-green-700 border-b pb-2">Tambah Artikel Baru</h2>
                        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                                    <input type="text" name="judul" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Sumber (URL)</label>
                                    <input type="url" name="link" placeholder="https://..." required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                                    <input type="file" name="gambar" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    <p class="text-xs text-gray-400 mt-1">*Format: JPG, PNG, JPEG (Maks 2MB)</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition shadow-md">
                                    <i class="fa fa-plus mr-1"></i> Simpan Artikel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Artikel -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4 border-b bg-gray-50">
                            <h2 class="font-semibold text-gray-700">Daftar Artikel Aktif</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-100 text-gray-600 text-xs uppercase font-bold">
                                    <tr>
                                        <th class="px-6 py-3">Gambar</th>
                                        <th class="px-6 py-3">Info Artikel</th>
                                        <th class="px-6 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($artikels as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/artikel/' . $item->gambar) }}" class="w-24 h-16 object-cover rounded-md shadow-sm border" alt="Preview">
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-bold text-gray-800">{{ $item->judul }}</p>
                                            <p class="text-xs text-blue-600 truncate max-w-xs">{{ $item->link }}</p>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $item->deskripsi }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.artikel.delete', $item->id) }}" onclick="return confirm('Hapus artikel ini?')" title="Hapus" class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-md transition">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">
                                            <div class="flex flex-col items-center">
                                                <i class="fa fa-newspaper text-4xl mb-3 text-gray-300"></i>
                                                <p>Belum ada artikel yang ditambahkan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>

</html>