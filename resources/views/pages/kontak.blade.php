<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - Bimalukarstable</title>
    {{-- Memuat Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-green-700">Bimalukarstable</div>
            <nav class="space-x-6 text-sm font-medium flex items-center">
                {{-- Gunakan {{ route('nama_route') }} jika route didefinisikan dengan nama --}}
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600">Beranda</a>
                <a href="{{ url('galeri') }}" class="text-gray-700 hover:text-green-600">Galeri</a>
                <a href="{{ url('artikel') }}" class="text-text-gray-700 hover:text-green-600">Artikel</a>
                <a href="{{ url('kontak') }}" class="text-green-700 font-semibold">Kontak</a>

                <!-- PERBAIKAN: Menggunakan url('login') agar konsisten dengan navigasi lain -->
                <a href="{{ url('login') }}"
                    class="ml-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Daftar Sekarang
                </a>
            </nav>
        </div>
    </header>

    <section class="bg-gradient-to-r from-green-800 to-green-700 text-white py-16 px-6 md:px-20">
        <div class="grid md:grid-cols-2 items-center gap-10">
            <div>
                <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
                <p class="text-gray-300">jika ingin mendaftar silahkan menekan tombol daftar disebelah kanan atas dan apabila ada yang ingin ditanyakan silahkan untuk langsung kontak email yang ada dibawah ini.</p>
            </div>
            <div class="flex justify-center">
                {{-- Gunakan {{ asset('path/ke/file') }} untuk memuat aset dari folder public --}}
                <img src="{{ asset('img/imgkontak/1.jpg') }}" alt="Profile" class="w-64 h-64 object-cover rounded-full shadow-2xl border-4 border-white">
            </div>
        </div>
    </section>


    <section class="bg-white py-12 px-6 md:px-20">
        <div class="grid md:grid-cols-3 gap-10 text-center">
            <div>
                <p class="text-sm text-gray-500">Telepon</p>
                <h3 class="text-lg font-semibold">0878 8286 6945</h3>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <h3 class="text-lg font-semibold">bagasdru4625@gmail.com</h3>
            </div>
            <div>
                <p class="text-sm text-gray-500">Lokasi</p>
                <h3 class="text-lg font-semibold">ds Singasari Kec. Jonggol Kab. Bogor</h3>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-20 pb-20">
        {{-- Ganti URL Iframe ke yang sebenarnya, atau biarkan dummy --}}
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.266944047311!2d107.02185357609136!3d-6.472950463397501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69bdebdf890abd%3A0x4f26a14420ae96e0!2sBimalukar%20Stable%20Jonggol!5e0!3m2!1sid!2sid!4v1724226420000!5m2!1sid!2sid"
            width="100%"
            height="400"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            class="rounded-2xl shadow-lg w-full"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

</body>
</html>