<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimalukarstable - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-green-700">Bimalukarstable</div>
            <nav class="space-x-6 text-sm font-medium flex items-center">
                <a href="{{ url('/') }}" class="text-text-gray-700 hover:text-green-600">Beranda</a>
                <a href="{{ url('galeri') }}" class="text-green-700 font-semibold">Galeri</a>
                <a href="{{ url('artikel') }}" class="text-text-gray-700 hover:text-green-600">Artikel</a>
                <a href="{{ url('kontak') }}" class="text-gray-700 hover:text-green-600">Kontak</a>

                <!-- PERBAIKAN: Menggunakan url('login') agar konsisten dengan navigasi lain -->
                <a href="{{ url('login') }}"
                    class="ml-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Daftar Sekarang
                </a>
            </nav>
        </div>
    </header>

    <section class="px-6 md:px-16 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12 relative">

            <div>
                <h1 class="text-4xl font-bold mb-4 leading-tight">
                    Bimalukarstable <span class="text-green-700">Gambar yang berupa monument mengenai kuda</span>
                </h1>
                <p class="text-gray-600 mb-6">
                    Di Bimalukar Stable, setiap momen berkuda punya cerita tersendiri, dan melalui galeri foto kami kamu bisa melihat bagaimana serunya pengalaman itu — mulai dari ekspresi bahagia para pengendara, momen penuh kebanggaan saat berhasil mengendalikan kuda, hingga suasana hangat kebersamaan yang tercipta di arena; setiap potret bukan hanya gambar, tapi gambaran nyata tentang kebebasan, ketenangan, serta kegembiraan yang hanya bisa dirasakan ketika menyatu dengan alam dan kuda, menjadikan berkuda bukan sekadar olahraga, melainkan pengalaman hidup yang tak terlupakan.
                </p>
            </div>

            <div class="relative w-full h-[400px] flex justify-center items-center">
                
                <div class="absolute z-10 w-40 h-64 bg-gray-300 rounded-xl shadow-md flex items-center justify-center animate-fadeInUp" style="animation-delay: 0.2s;">
                    <video autoplay muted loop playsinline 
                           class="w-full h-full object-cover rounded-xl"
                           style="pointer-events: none; user-select: none;">
                        <source src="{{ asset('img/imggaleri/GAMBAR ATAS/1.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung video.
                    </video>
                </div>

                <div class="absolute right-0 top-0 w-32 h-44 bg-gray-300 rounded-xl shadow-md flex items-center justify-center animate-fadeInUp" style="animation-delay: 0.6s;">
                    <video autoplay muted loop playsinline 
                           class="w-full h-full object-cover rounded-xl pointer-events-none select-none">
                        <source src="{{ asset('img/imggaleri/GAMBAR ATAS/2.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung video.
                    </video>
                </div>

                <div class="absolute right-0 bottom-0 w-32 h-44 bg-gray-300 rounded-xl shadow-md flex items-center justify-center animate-fadeInUp" style="animation-delay: 1s;">
                    <video autoplay muted loop playsinline 
                           class="w-full h-full object-cover rounded-xl pointer-events-none select-none">
                        <source src="{{ asset('img/imggaleri/GAMBAR ATAS/3.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung video.
                    </video>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center mb-12">
        <h2 class="text-3xl font-semibold tracking-widest uppercase">Gallery for horses</h2>
    </section>

    <section class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 px-6 md:px-12 mb-16">
        {{-- Menggunakan @forelse untuk perulangan data galeri --}}
        @forelse ($galeri as $index => $row)
            <div class="fade-in-up bg-white rounded-lg shadow hover:shadow-lg transition p-3" style="animation-delay: {{ $index * 0.1 }}s;">
                <img src="{{ asset($row->path_gambar) }}" 
                     alt="{{ $row->alt_text ?? 'Gambar galeri Bimalukarstable' }}" 
                     class="w-full h-full object-cover rounded-md mb-3">
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 py-12">
                Tidak ada gambar di galeri saat ini.
            </div>
        @endforelse
    </section>

    <footer class="bg-green-900 text-white px-6 md:px-16 py-12">
        <div class="grid md:grid-cols-3 gap-8">

            <div>
                <img src="{{ asset('img/profil.jpeg') }}" alt="Logo Bimalukar" class="w-20 h-20 mb-4 rounded-full shadow-lg">
                <p class="text-white leading-relaxed">
                    <span class="font-semibold">Bimalukarstable</span> adalah destinasi rekreasi keluarga lengkap dengan fasilitas olahraga dan kuliner.
                </p>
            </div>

            <div class="space-y-2">
                <p class="font-semibold">Kontak</p>
                <ul class="space-y-1 text-sm">
                    <li>📞 0815-8469-5946</li>
                    <li>📍 Jl. Singasari,Kec. Jonggol<br> Kabupaten Bogor<br>Jawa Barat 16830</li>
                </ul>
            </div>
        </div>

        <div class="mt-8">
            <iframe
                src="https://maps.google.com/maps?q=Bimalukarstable%20Jonggol&t=&z=13&ie=UTF8&iwloc=&output=embed"
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="text-center text-sm mt-6 text-gray-300">
            Copyright © 2024 <span class="text-white font-semibold">bimalukarstable</span>. All Rights Reserved.
        </div>
    </footer>

</body>
</html>