<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

<section class="flex min-h-screen">

    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between z-50">
        <div>
            <h2 class="text-lg font-semibold text-green-900 mb-6 px-4">Admin Panel</h2>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                    Dashboard Keuangan
                </a>
                <a href="{{ route('admin.data_keuangan') }}" class="block px-4 py-2 rounded-lg bg-teal-600 text-white font-semibold transition">
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
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Pendaftaran</h1>
            <a href="{{ route('admin.data_keuangan') }}" class="text-teal-600 hover:text-teal-800 font-medium">
                <i class="fa fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-4xl">
            
            {{-- Form Edit --}}
            {{-- Perhatikan route mengarah ke 'update' dan method POST dengan @method('PUT') --}}
            <form action="{{ route('admin.pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                        <input type="text" name="nomor_wa" value="{{ old('nomor_wa', $data->nomor_wa) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Tinggal</label>
                        <input type="text" name="tempat_tinggal" value="{{ old('tempat_tinggal', $data->tempat_tinggal) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trainer</label>
                        <select name="trainer" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            <option value="Agung" {{ $data->trainer == 'Agung' ? 'selected' : '' }}>Agung</option>
                            <option value="Aji" {{ $data->trainer == 'Aji' ? 'selected' : '' }}>Aji</option>
                            <option value="Haryanto" {{ $data->trainer == 'Haryanto' ? 'selected' : '' }}>Haryanto</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Latihan</label>
                        <select name="program_latihan" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            <option value="Private" {{ $data->program_latihan == 'Private' ? 'selected' : '' }}>Private</option>
                            <option value="Reguler" {{ $data->program_latihan == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="Harian" {{ $data->program_latihan == 'Harian' ? 'selected' : '' }}>Harian</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Anggota</label>
                        <select name="kategori_anggota" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            <option value="Anak-anak" {{ $data->kategori_anggota == 'Anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                            <option value="Dewasa" {{ $data->kategori_anggota == 'Dewasa' ? 'selected' : '' }}>Dewasa</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Latihan</label>
                        <input type="text" name="jadwal_latihan" value="{{ old('jadwal_latihan', $data->jadwal_latihan) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none" required>
                    </div>

                    <div class="md:col-span-2 border-t pt-4 mt-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pembayaran</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            <option value="Transfer" {{ $data->metode_pembayaran == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="Tunai" {{ $data->metode_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal', $data->nominal) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Pembayaran (Opsional)</label>
                        
                        @if ($data->bukti_pembayaran_path && $data->bukti_pembayaran_path != 'Tidak Ada Bukti')
                            <div class="mb-3">
                                <span class="text-xs text-gray-500 block mb-1">Bukti saat ini:</span>
                                <img src="{{ asset($data->bukti_pembayaran_path) }}" alt="Bukti Lama" class="h-20 w-auto rounded border border-gray-200 p-1">
                            </div>
                        @endif

                        <input type="file" name="bukti_pembayaran" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah bukti pembayaran.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t mt-6">
                    <a href="{{ route('admin.data_keuangan') }}" class="px-6 py-2 rounded-lg text-gray-600 bg-gray-100 hover:bg-gray-200 transition font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 rounded-lg text-white bg-teal-600 hover:bg-teal-700 transition font-medium shadow-lg shadow-teal-500/30">
                        <i class="fa fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
</section>

</body>
</html>