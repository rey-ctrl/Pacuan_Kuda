<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pacuan_kuda";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
