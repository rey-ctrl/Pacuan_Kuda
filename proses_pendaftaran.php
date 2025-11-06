<?php
// Pastikan skrip ini hanya berjalan jika form dikirim (submit_pendaftaran ditekan)
if (!isset($_POST['submit_pendaftaran'])) {
    // Redirect kembali ke form jika diakses langsung sesuai permintaan
    header('Location: pendaftaran.html'); 
    exit();
}

// 1. INCLUDE FILE KONEKSI
include 'connect.php'; // Mengambil variabel $conn yang sudah terkoneksi

// GANTI: Nama tabel Anda
$table = "pendaftaran";        


// 2. AMBIL DATA DARI FORM
// Menggunakan real_escape_string untuk sanitasi data string
$nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
$nomor_wa = $conn->real_escape_string($_POST['nomor_wa']);
$tempat_tinggal = $conn->real_escape_string($_POST['tempat_tinggal']);
$jadwal_latihan = $conn->real_escape_string($_POST['jadwal_latihan']);
$trainer = $conn->real_escape_string($_POST['trainer']);
$program_latihan = $conn->real_escape_string($_POST['program_latihan']);
$kategori_anggota = $conn->real_escape_string($_POST['kategori_anggota']);
$metode_pembayaran = $conn->real_escape_string($_POST['metode_pembayaran']);
$nominal = $conn->real_escape_string($_POST['nominal']);


$bukti_pembayaran_path = "Tidak Ada Bukti"; // Nilai default jika tidak ada file di-upload

// 3. PROSES UPLOAD FILE FOTO (Bukti Pembayaran)
if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
    
    // Folder tujuan di server (HARUS SUDAH DIBUAT di direktori ini!)
    $target_dir = "uploads/";
    
    $file_info = $_FILES['bukti_pembayaran'];
    $file_name = $file_info['name'];
    $file_tmp = $file_info['tmp_name'];
    $file_size = $file_info['size'];

    // Membuat nama file unik (PENTING)
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid('bukti_') . '.' . $file_ext;
    $target_file = $target_dir . $new_file_name;

    // Filter file
    $allowed_ext = array('jpg', 'jpeg', 'png');
    $max_size = 5 * 1024 * 1024; // Maksimum 5MB

    if (!in_array($file_ext, $allowed_ext)) {
        header('Location: pendaftaran.html?status=gagal&msg=Jenis file bukti pembayaran tidak didukung.');
        exit();
    }

    if ($file_size > $max_size) {
        header('Location: pendaftaran.html?status=gagal&msg=Ukuran file bukti pembayaran terlalu besar (maks 5MB).');
        exit();
    }
    
    // Pindahkan file dan simpan path ke variabel
    if (move_uploaded_file($file_tmp, $target_file)) {
        $bukti_pembayaran_path = $conn->real_escape_string($target_file); // Path relatif yang disimpan
    } else {

        header('Location: pendaftaran.html?status=gagal&msg=Gagal memindahkan file bukti pembayaran ke server.');
        exit();
    }
} 


// 4. SIMPAN DATA KE DATABASE (Menggunakan Prepared Statements untuk keamanan)
$stmt = $conn->prepare("INSERT INTO $table (
    nama_lengkap, nomor_wa, tempat_tinggal, jadwal_latihan, trainer, 
    program_latihan, kategori_anggota, metode_pembayaran, nominal, bukti_pembayaran_path, tgl_pendaftaran
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

// Bind parameter (s: string)
$stmt->bind_param("ssssssssss", 
    $nama_lengkap, 
    $nomor_wa, 
    $tempat_tinggal, 
    $jadwal_latihan, 
    $trainer, 
    $program_latihan, 
    $kategori_anggota, 
    $metode_pembayaran, 
    $nominal,
    $bukti_pembayaran_path
);

if ($stmt->execute()) {
    // Sukses: Redirect kembali ke form dengan pesan sukses
    header('Location: pendaftaran.html?status=sukses');
    exit();
} else {
    // Gagal: Redirect kembali ke form dengan pesan error
    // echo "Error: " . $stmt->error; // Untuk debugging
    header('Location: pendaftaran.html?status=gagal&msg=Kesalahan saat menyimpan data ke database.');
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();

?>
