<?php
include '../connect.php';
$result = $conn->query("SELECT * FROM pendaftaran ORDER BY tgl_pendaftaran DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Keuangan - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<section class="flex">

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

  <!-- Konten Utama -->
  <main class="flex-1 ml-64 p-10 overflow-y-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Pendaftar & Keuangan</h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow">
      <table class="min-w-full border border-gray-200 rounded-xl">
        <thead class="bg-teal-600 text-white text-sm">
          <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left">Nama Lengkap</th>
            <th class="px-4 py-3 text-left">Nomor WA</th>
            <th class="px-4 py-3 text-left">Tempat Tinggal</th>
            <th class="px-4 py-3 text-left">Jadwal</th>
            <th class="px-4 py-3 text-left">Trainer</th>
            <th class="px-4 py-3 text-left">Program Latihan</th>
            <th class="px-4 py-3 text-left">Kategori Anggota</th>
            <th class="px-4 py-3 text-left">Metode Pembayaran</th>
            <th class="px-4 py-3 text-left">Nominal</th>
            <th class="px-4 py-3 text-left">Bukti Pembayaran</th>
            <th class="px-4 py-3 text-left">Tanggal Pendaftaran</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
          <?php if ($result->num_rows > 0): ?>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-3"><?= $no ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['nomor_wa']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['tempat_tinggal']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['jadwal_latihan']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['trainer']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['program_latihan']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['kategori_anggota']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
                <td class="px-4 py-3">
                  <?php if (!empty($row['nominal'])): ?>
                    Rp <?= number_format($row['nominal'], 0, ',', '.') ?>
                  <?php else: ?>
                    <span class="text-gray-400">-</span>
                  <?php endif; ?>
                </td>
                <td class="px-4 py-3">
                  <?php if (!empty($row['bukti_pembayaran_path']) && $row['bukti_pembayaran_path'] != 'Tidak Ada Bukti'): ?>
                    <?php $baseURL = "http://localhost/pacuan_kuda/"; ?>
                    <a href="<?= $baseURL . $row['bukti_pembayaran_path'] ?>" target="_blank" class="text-teal-600 underline hover:text-teal-800">Lihat</a>
                  <?php else: ?>
                    <span class="text-gray-400">-</span>
                  <?php endif; ?>
                </td>
                <td class="px-4 py-3 text-gray-500"><?= $row['tgl_pendaftaran'] ?></td>
              </tr>
              <?php $no++; endwhile; ?>
          <?php else: ?>
              <tr><td colspan="12" class="text-center py-4 text-gray-500">Belum ada data pendaftaran.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

</section>
</body>
</html>
