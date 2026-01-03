<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bimalukarstable - Dunia Kuda</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Animasi fade-in untuk seluruh halaman */
        body {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        body.loaded {
            opacity: 1;
        }

        /* Animasi muncul dari bawah */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 1s ease-out forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
</head>

<body class="bg-gray-100 text-gray-800">
    <script>
        // Untuk menambahkan class loaded saat halaman selesai dimuat
        window.addEventListener("load", () => {
            document.body.classList.add("loaded");
        });
    </script>
    
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-green-700">Bimalukarstable</div>
            <nav class="space-x-6 text-sm font-medium flex items-center">
                <a href="{{ url('/') }}" class="text-green-700 font-semibold">Beranda</a>
                <a href="{{ url('galeri') }}" class="text-gray-700 hover:text-green-600">Galeri</a>
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
    
    <main>
        <section class="relative bg-green-600 text-white py-20 bg-[url('{{ asset('img/home1.jpg') }}')] bg-cover bg-center">
            <div class="absolute inset-0 bg-green-900 bg-opacity-60"></div>
            <div class="relative max-w-3xl mx-auto text-center px-6 fade-up">
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di Dunia Kuda</h1>
                <p class="text-lg mb-6">Temukan jenis kuda terbaik, acara komunitas, dan inspirasi pecinta kuda.</p>
                <a href="{{ url('artikel') }}" class="bg-white text-green-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-100 transition duration-300">Jelajahi Sekarang</a>
            </div>
        </section>

        <section class="bg-white py-16 px-6 md:px-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Tempat Rekreasi Keluarga, Latihan Berkuda & Panahan Terbaik di Jonggol
                </h1>
                <p class="text-gray-600 mt-6 text-lg leading-relaxed">
                    Nikmati pengalaman rekreasi bersama keluarga dan latihan berkuda dan panahan bersama coach profesional hanya di Hub Indonesia.
                </p>
                <div class="mt-8">
                    <div class="inline-flex items-center gap-4 px-6 py-3 border border-black rounded-full shadow-md">
                        <span class="font-medium text-sm">Follow Me :</span>
                        <a href="https://www.instagram.com/bimalukarstable"><img src="{{ asset('img/logoimg/instagram-logo.png') }}" alt="Instagram" class="w-5" /></a>
                        <a href="https://www.facebook.com/bimalukar.stable?locale=id_ID"><img src="{{ asset('img/logoimg/facebook-app-symbol.png') }}" alt="Facebook" class="w-5" /></a>
                        <a href="#"><img src="{{ asset('img/logoimg/whatsapp.png') }}" alt="WhatsApp" class="w-5" /></a>
                    </div>
                </div>
            </div>

            <div class="relative w-full">
                <img src="{{ asset('img/imgindex/kuda.jpeg') }}" alt="Hero Image" class="w-full rounded-lg shadow-lg" />
            </div>
        </section>

        <section class="bg-white px-6 py-16 md:px-16 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="w-full">
                <img src="{{ asset('img/imgindex/image_copy.png') }}" alt="Event Aragon Merdeka" class="w-full rounded-lg shadow-lg" />
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                    Lokasi yang luas untuk latihan dan mencoba hal baru di bimalukarstable
                </h2>
                <p class="text-gray-600 mt-6 text-lg leading-relaxed">
                    Jika ingin mendaftar maka silahkan masuk klik kedalam kotak yang ada dibawah untuk mencoba traning di dalam bimalukarstable
                </p>
                <div class="mt-8">
                    <a href="{{ url('pendaftaran') }}" class="inline-block bg-green-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-green-700 transition duration-300">Daftar Sekarang</a>
                </div>
            </div>
        </section>
    </main>
    
</body>
</html>