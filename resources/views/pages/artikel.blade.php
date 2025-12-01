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

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-green-700">Bimalukarstable</div>
            <nav class="space-x-6 text-sm font-medium flex items-center">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600">Beranda</a>
                <a href="{{ url('galeri') }}" class="text-gray-700 hover:text-green-600">Galeri</a>
                <a href="{{ url('artikel') }}" class="text-green-700 font-semibold">Artikel</a>
                <a href="{{ url('kontak') }}" class="text-gray-700 hover:text-green-600">Kontak</a>

                <a href="{{ url('login') }}"
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

                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition overflow-hidden" data-aos="fade-up">
                    <img src="{{ asset('img/imgevent/artikel1.jpeg') }}" class="w-full h-48 object-cover" alt="Berkuda: Sejarah, Manfaat, dan Teknik Dasar">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-800 mb-2">Berkuda: Sejarah, Manfaat, dan Teknik Dasar</h3>
                        <button onclick="window.open('https://id.linkedin.com/pulse/berkuda-sejarah-manfaat-dan-teknik-dasar-widya-kurniawan-8lymc', '_blank')"
                            class="text-sm text-white bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Lihat Artikel lengkap
                        </button>
                        <p class="text-gray-700 mt-3 text-sm line-clamp-4">Berkuda adalah olahraga yang menyatukan manusia dan hewan dalam harmoni yang indah, memiliki sejarah panjang sejak ribuan tahun lalu sebagai alat transportasi, simbol kejayaan, hingga kini menjadi ajang olahraga bergengsi; dalam Islam, berkuda juga mendapat kedudukan istimewa karena dianjurkan Rasulullah SAW sebagai sarana melatih fisik, keberanian, dan kesabaran, sehingga lebih dari sekadar olahraga, berkuda menjadi perjalanan spiritual dan rekreasi yang menyehatkan tubuh, menenangkan jiwa, serta mengajarkan makna keseimbangan antara manusia, hewan, dan Sang Pencipta.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('img/imgevent/artikel2.jpeg') }}" class="w-full h-48 object-cover" alt="Jenis-jenis olahraga berkuda">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-800 mb-2">Jenis-jenis olahraga berkuda</h3>
                        <button onclick="window.open('https://hellosehat.com/kebugaran/olahraga-lainnya/olahraga-berkuda/#goog_rewarded', '_blank')"
                            class="text-sm text-white bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Lihat Artikel lengkap
                        </button>
                        <p class="text-gray-700 mt-3 text-sm line-clamp-4">Jenis-jenis olahraga berkuda yang populer terdiri dari dressage, show jumping, dan eventing; dressage atau tunggang serasi menekankan keselarasan gerakan penunggang dan kuda dalam arena dengan pola tertentu, show jumping menampilkan ketangkasan melompati rintangan dengan kecepatan dan ketepatan tinggi, sedangkan eventing menggabungkan tiga disiplin sekaligus—dressage, cross-country, dan show jumping—yang menguji kekuatan, ketahanan, serta keterampilan penunggang dan kudanya secara menyeluruh.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('img/imgevent/artikel3.jpeg') }}" class="w-full h-48 object-cover" alt="Persiapan Sebelum Berkuda">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-800 mb-2">Persiapan Sebelum Berkuda</h3>
                        <button onclick="window.open('https://kumparan.com/seputar-hobi/cara-berkuda-yang-benar-untuk-pemula-agar-tidak-cedera-23ViEIcQCK4/gallery/2', '_blank')"
                            class="text-sm text-white bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Lihat Artikel lengkap
                        </button>
                        <p class="text-gray-700 mt-3 text-sm line-clamp-4">Bagi pemula, persiapan sebelum berkuda sangat penting agar aktivitas ini aman dan menyenangkan, dimulai dengan memilih kuda yang tepat—sebaiknya kuda yang tenang, berpengalaman, dan mudah dikendalikan, bukan yang agresif atau terlalu cepat; kemudian mengenakan perlengkapan yang sesuai seperti helm, sepatu bot, pakaian nyaman, serta memastikan pelana dan kendali terpasang dengan benar; terakhir, memahami bahasa tubuh kuda melalui tanda-tanda seperti gerakan telinga atau ekor, sehingga pengendara dapat menjalin komunikasi yang baik, merespons dengan tepat, dan menghindari risiko yang tidak diinginkan.</p>
                    </div>
                </div>


            </div>
        </div>
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


    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>