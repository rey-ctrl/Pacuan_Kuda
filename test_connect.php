<?php
$servername = "localhost"; // gunakan 'localhost', bukan 127.0.0.1
$username = "root";
$password = ""; // karena kamu login tanpa password
$dbname = "pacuan_kuda";
$port = 3308;   // ubah sesuai hasil SHOW VARIABLES LIKE 'port';

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("❌ Koneksi gagal: " . $conn->connect_error);
}
echo "✅ Koneksi berhasil ke database '$dbname'!";
?>
