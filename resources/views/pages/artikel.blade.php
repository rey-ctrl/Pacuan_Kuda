<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artikel - Bimalukarstable</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-green-700">Bimalukarstable</div>
            <nav class="space-x-6 text-sm font-medium flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600">Beranda</a>
                <a href="{{ route('galeri.index') }}" class="text-gray-700 hover:text-green-600">Galeri</a>
                <a href="{{ route('artikel.index') }}" class="text-green-700 font-semibold">Artikel</a>
                <a href="{{ route('kontak') }}" class="text-gray-700 hover:text-green-600">Kontak</a>

                <a href="{{ route('login') }}"
                    class="ml-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Pendaftaran
                </a>
            </nav>
        </div>
    </header>

    <section id="artikel" class="py-16 bg-white" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-green-700 mb-12 text-center" data-aos="fade-up">Artikel Bimalukarstable</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Bagian Looping Dinamis --}}
                @forelse($artikels as $key => $item)
                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition overflow-hidden border border-gray-100" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $key * 100 }}">
                    
                    {{-- Pastikan path gambar sesuai dengan yang di-upload di AdminArtikelController --}}
                    <img src="{{ asset('img/artikel/' . ($item->gambar ?? 'default.jpg')) }}" 
                         class="w-full h-56 object-cover" 
                         alt="{{ $item->judul }}"
                         onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=Gambar+Tidak+Tersedia';">
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-800 mb-3 leading-tight">{{ $item->judul }}</h3>
                        
                        <p class="text-gray-600 mb-5 text-sm line-clamp-3 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>

                        <a href="{{ $item->link }}" target="_blank"
                            class="inline-block text-center w-full text-sm text-white bg-green-600 px-4 py-2.5 rounded-lg hover:bg-green-700 transition font-medium">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
                @empty
                {{-- Tampilan jika database kosong --}}
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v4a2 2 0 002 2h4"></path>
                        </svg>
                        <p class="text-gray-500 italic">Belum ada artikel yang tersedia saat ini.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-900 text-white px-6 md:px-16 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            <div>
                <img src="{{ asset('img/profil.jpeg') }}" alt="Logo Bimalukar" class="w-20 h-20 mb-4 rounded-full shadow-lg border-2 border-green-700">
                <p class="text-gray-200 leading-relaxed text-sm">
                    <span class="font-semibold text-white">Bimalukarstable</span> adalah destinasi rekreasi keluarga lengkap dengan fasilitas olahraga berkuda, memanah, dan kuliner.
                </p>
            </div>

            <div class="space-y-4">
                <p class="font-semibold text-lg border-b border-green-800 pb-2">Kontak Kami</p>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-center"><i class="fa fa-phone mr-3 text-green-400"></i> 0815-8469-5946</li>
                    <li class="flex items-start"><i class="fa fa-map-marker-alt mr-4 mt-1 text-green-400"></i> 
                        Jl. Singasari, Kec. Jonggol<br> Kabupaten Bogor, Jawa Barat 16830
                    </li>
                </ul>
            </div>
            
            <div class="space-y-4">
                <p class="font-semibold text-lg border-b border-green-800 pb-2">Lokasi Kami</p>
                <div class="rounded-lg overflow-hidden h-32">
                    <iframe
                        src="https://maps.google.com/maps?q=Bimalukarstable%20Jonggol&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="text-center text-xs mt-12 pt-8 border-t border-green-800 text-gray-400">
            Copyright © 2024 <span class="text-white font-semibold">bimalukarstable</span>. All Rights Reserved.
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>