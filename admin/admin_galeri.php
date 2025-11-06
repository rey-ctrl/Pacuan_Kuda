<?php
include '../connect.php';

// --- Konfigurasi Folder Upload ---
$upload_dir = "../img/imggaleri/gambar bawah/";
$db_path_prefix = "img/imggaleri/gambar bawah/";

// --- Hapus Gambar ---
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("SELECT path_gambar FROM galeri_gambar WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $file_path = "../" . $result['path_gambar'];
        if (file_exists($file_path)) unlink($file_path);
    }

    $stmt = $conn->prepare("DELETE FROM galeri_gambar WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_galeri.php?status=deleted");
    exit();
}

// --- Tambah Gambar Baru ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_gambar'])) {
    $desc = trim($_POST['deskripsi'] ?? '');
    $msg = "";

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png"];
        $unique_name = uniqid("img_", true) . "." . $ext;
        $upload_path = $upload_dir . $unique_name;
        $db_path = $db_path_prefix . $unique_name;

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check && in_array($ext, $allowed)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $upload_path)) {
                $stmt = $conn->prepare("INSERT INTO galeri_gambar (path_gambar, deskripsi) VALUES (?, ?)");
                $stmt->bind_param("ss", $db_path, $desc);
                $stmt->execute();
                header("Location: admin_galeri.php?status=added");
                exit();
            } else {
                $msg = "Gagal mengunggah file.";
            }
        } else {
            $msg = "File tidak valid (hanya JPG, JPEG, PNG).";
        }
    } else {
        $msg = "Silakan pilih file gambar.";
    }
}

// --- Ambil Data Galeri ---
$result = $conn->query("SELECT * FROM galeri_gambar ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Galeri</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .thumb { width: 90px; height: 90px; object-fit: cover; border-radius: 6px; }
  </style>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

  <!-- Sidebar (fixed) -->
    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-xl p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-lg font-semibold text-green-900 mb-6">Admin Panel</h2>
        <nav class="space-y-2">
          <a href="bankio_dashboard.php" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
            Dashboard
          </a>
          <a href="data_keuangan.php" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
            Data Keuangan
          </a>
          <a href="Data Register.html" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
            Data Register
          </a>
          <a href="admin_galeri.php" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
            Manajemen Galeri
          </a>
        </nav>
      </div>
    </aside>

  <!-- Konten -->
  <main class="ml-72 flex-1 p-8">
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <h1 class="text-3xl font-bold text-green-700 mb-6 border-b pb-3">Manajemen Galeri</h1>

      <!-- Notifikasi -->
      <?php if (isset($_GET['status']) || isset($msg)): ?>
        <div class="mb-5 p-3 rounded-md 
            <?= ($_GET['status'] ?? '') === 'added' ? 'bg-green-100 text-green-700 border border-green-300' : 
               (($_GET['status'] ?? '') === 'deleted' ? 'bg-yellow-100 text-yellow-700 border border-yellow-300' : 
               'bg-red-100 text-red-700 border border-red-300') ?>">
          <?php
            if (isset($_GET['status']) && $_GET['status'] === 'added') echo "Foto berhasil ditambahkan.";
            elseif (isset($_GET['status']) && $_GET['status'] === 'deleted') echo "Foto berhasil dihapus.";
            elseif (isset($msg)) echo "⚠️ $msg";
          ?>
        </div>
      <?php endif; ?>

      <!-- Form Upload -->
      <div class="mb-8 border p-5 rounded-xl bg-green-50">
        <h2 class="text-xl font-semibold text-green-700 mb-4">Tambah Foto Baru</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Foto</label>
            <input type="file" name="foto" class="block w-full border border-gray-300 rounded-md p-2" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="block w-full border border-gray-300 rounded-md p-2"></textarea>
          </div>
          <button type="submit" name="tambah_gambar" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
            Upload Foto
          </button>
        </form>
      </div>

      <!-- Tabel Galeri -->
      <h2 class="text-xl font-semibold text-gray-800 mb-3">Daftar Galeri</h2>
      <div class="overflow-x-auto border rounded-lg">
        <table class="min-w-full text-sm text-gray-700">
          <thead class="bg-gray-100 border-b">
            <tr>
              <th class="px-6 py-3 text-left font-semibold">ID</th>
              <th class="px-6 py-3 text-left font-semibold">Gambar</th>
              <th class="px-6 py-3 text-left font-semibold">Deskripsi</th>
              <th class="px-6 py-3 text-left font-semibold">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0): ?>
              <?php while($row = $result->fetch_assoc()): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-6 py-3"><?= $row['id'] ?></td>
                  <td class="px-6 py-3">
                    <img src="../<?= htmlspecialchars($row['path_gambar']) ?>" alt="Gambar" class="thumb">
                  </td>
                  <td class="px-6 py-3"><?= htmlspecialchars($row['deskripsi'] ?: '-') ?></td>
                  <td class="px-6 py-3">
                    <a href="admin_galeri.php?delete_id=<?= $row['id'] ?>" 
                       onclick="return confirm('Yakin ingin menghapus foto ini?')"
                       class="text-red-600 hover:text-red-800">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-gray-500 py-4">Belum ada foto.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>
</body>
</html>
