<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Pendaftaran Horse Riding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        .container-wrapper { max-width: 1400px; width: 100%; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p-4">

    {{-- MODAL SUKSES (Tampilkan jika flash session 'status' adalah 'sukses') --}}
    @if (session('status') === 'sukses')
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl p-8 text-center max-w-sm mx-auto">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Pendaftaran Berhasil!</h2>
            <p class="text-gray-600 mb-6">Terima kasih sudah mendaftar. Kami akan segera menghubungi Anda melalui WhatsApp.</p>
            <button onclick="closeModal('successModal')" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                Tutup
            </button>
        </div>
    </div>
    @endif

    {{-- MODAL GAGAL (Tampilkan jika flash session 'status' adalah 'gagal' atau ada error validasi) --}}
    @if (session('status') === 'gagal' || $errors->any())
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl p-8 text-center max-w-sm mx-auto">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Pendaftaran Gagal</h2>
            
            {{-- Tampilkan error validasi atau error database --}}
            <p class="text-gray-600 mb-6">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                @if (!$errors->any())
                    Terjadi kesalahan saat mengirim data. Coba lagi nanti.
                @endif
            </p>
            
            <button onclick="closeModal('errorModal')" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
                Tutup
            </button>
        </div>
    </div>
    @endif

    <div class="container-wrapper flex flex-col lg:flex-row items-start justify-center gap-8 p-4">
        <div class="hidden lg:flex flex-col items-center justify-center p-4 lg:w-1/2 sticky top-4">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Informasi Program Latihan</h3>
            <div class="rounded-xl shadow-2xl overflow-hidden border-4 border-white">
                <img src="{{ asset('img/pendaftaran/gambar.jpeg') }}" alt="Data Harga" class="rounded-lg shadow-lg max-h-[1500px] object-contain" />
            </div>
        </div>

        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-2xl w-full max-w-lg lg:w-1/2 mx-auto">
            <h2 class="text-3xl font-extrabold mb-6 text-center text-teal-600">Form Pendaftaran</h2>
            
            {{-- Form action diarahkan ke route POST pendaftaran.store --}}
            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf {{-- Token CSRF Wajib --}}
                
                <div>
                    <label for="nama_lengkap" class="block mb-1 font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" required 
                           value="{{ old('nama_lengkap') }}" 
                           class="w-full p-3 border border-gray-300 rounded-xl outline-none transition @error('nama_lengkap') border-red-500 @enderror" />
                    @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="nomor_wa" class="block mb-1 font-medium text-gray-700">Nomor WA</label>
                    <input type="text" id="nomor_wa" name="nomor_wa" required 
                           value="{{ old('nomor_wa') }}" 
                           class="w-full p-3 border border-gray-300 rounded-xl outline-none transition @error('nomor_wa') border-red-500 @enderror" />
                    @error('nomor_wa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tempat_tinggal" class="block mb-1 font-medium text-gray-700">Tempat Tinggal</label>
                    <input type="text" id="tempat_tinggal" name="tempat_tinggal" required 
                           value="{{ old('tempat_tinggal') }}" 
                           class="w-full p-3 border border-gray-300 rounded-xl outline-none transition @error('tempat_tinggal') border-red-500 @enderror" />
                    @error('tempat_tinggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jadwal_latihan" class="block mb-1 font-medium text-gray-700">Jadwal Latihan</label>
                    <select id="jadwal_latihan" name="jadwal_latihan" required 
                            class="w-full p-3 border border-gray-300 rounded-xl bg-white outline-none @error('jadwal_latihan') border-red-500 @enderror">
                        <option value="">Pilih Jadwal Latihan</option>
                        @php $jadwals = ['Selasa Sore', 'Kamis Sore', 'Sabtu Sore', 'Minggu Sore']; @endphp
                        @foreach ($jadwals as $jadwal)
                            <option value="{{ $jadwal }}" {{ old('jadwal_latihan') == $jadwal ? 'selected' : '' }}>{{ $jadwal }}</option>
                        @endforeach
                    </select>
                    @error('jadwal_latihan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="trainer" class="block mb-1 font-medium text-gray-700">Trainer</label>
                    <select id="trainer" name="trainer" required 
                            class="w-full p-3 border border-gray-300 rounded-xl bg-white outline-none @error('trainer') border-red-500 @enderror">
                        <option value="">Pilih Trainer</option>
                         @php $trainers = ['Nuriman', 'Yustuan/Pandi']; @endphp
                        @foreach ($trainers as $t)
                            <option value="{{ $t }}" {{ old('trainer') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('trainer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="program_latihan" class="block mb-1 font-medium text-gray-700">Kategori Latihan (Program)</label>
                    <select id="program_latihan" name="program_latihan" required 
                            class="w-full p-3 border border-gray-300 rounded-xl bg-white outline-none @error('program_latihan') border-red-500 @enderror">
                        <option value="">Pilih Program</option>
                        @php $programs = ['Private Lesson', 'Group Lesson', 'Horse Training', 'Paket Horse Training Bulanan', 'Paket Riding Lesson 10x (3 bulan)']; @endphp
                        @foreach ($programs as $program)
                            <option value="{{ $program }}" {{ old('program_latihan') == $program ? 'selected' : '' }}>{{ $program }}</option>
                        @endforeach
                    </select>
                    @error('program_latihan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="kategori_anggota" class="block mb-1 font-medium text-gray-700">Kategori Anggota</label>
                    <select id="kategori_anggota" name="kategori_anggota" required 
                            class="w-full p-3 border border-gray-300 rounded-xl bg-white outline-none @error('kategori_anggota') border-red-500 @enderror">
                        <option value="">Pilih Anggota</option>
                         @php $kategoris = ['Member', 'Non Member']; @endphp
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori }}" {{ old('kategori_anggota') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_anggota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="metode_pembayaran" class="block mb-1 font-medium text-gray-700">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" required 
                            class="w-full p-3 border border-gray-300 rounded-xl bg-white outline-none @error('metode_pembayaran') border-red-500 @enderror">
                        <option value="">Pilih Metode</option>
                        @php $metodes = ['Transfer Bank', 'Tunai']; @endphp
                        @foreach ($metodes as $metode)
                            <option value="{{ $metode }}" {{ old('metode_pembayaran') == $metode ? 'selected' : '' }}>{{ $metode }}</option>
                        @endforeach
                    </select>
                    @error('metode_pembayaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="nominal" class="block mb-1 font-medium text-gray-700">Nominal Pembayaran (Rp)</label>
                    <input type="number" id="nominal" name="nominal" placeholder="Contoh: 250000" required 
                           value="{{ old('nominal') }}"
                           class="w-full p-3 border border-gray-300 rounded-xl outline-none transition @error('nominal') border-red-500 @enderror" />
                    @error('nominal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bukti_pembayaran" class="block mb-1 font-medium text-gray-700">Bukti Pembayaran (Gambar)</label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" 
                           class="w-full border border-gray-300 rounded-xl bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition @error('bukti_pembayaran') border-red-500 @enderror" />
                    @error('bukti_pembayaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" name="submit_pendaftaran" class="w-full bg-teal-600 text-white p-4 rounded-xl font-bold text-lg hover:bg-teal-700 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-teal-300">
                    Kirim Pendaftaran
                </button>
            </form>
        </div>
    </div>

    <script>
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
                // Membersihkan URL query string
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
    </script>
</body>
</html>