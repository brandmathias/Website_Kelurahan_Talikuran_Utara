<?php
include('header.php');
include_once('../config/config.php');

$id = (int)($_GET['id'] ?? 0);
$r = $conn->query("SELECT * FROM laporan WHERE id=$id")->fetch_assoc();
if(!$r){
  echo "<script>
  Swal.fire({icon:'error', title:'Data tidak ditemukan', text:'Laporan tidak tersedia!'})
  .then(()=>window.location='laporan.php');
  </script>";
  exit;
}
?>

<div class="max-w-5xl mx-auto px-6 py-10" data-aos="fade-up">
  <a href="laporan.php" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 mb-6 transition">
    <i class="bi bi-arrow-left"></i> Kembali ke daftar laporan
  </a>

  <div class="bg-[#0f241c]/85 border border-emerald-700/40 backdrop-blur-md rounded-2xl p-8 shadow-[0_0_25px_rgba(16,185,129,0.2)]">
    <h2 class="text-3xl font-extrabold text-emerald-300 mb-5 flex items-center gap-3">
      <i class="bi bi-info-circle-fill"></i> <?= htmlspecialchars($r['judul_laporan']) ?>
    </h2>

    <ul class="space-y-2 text-emerald-100">
      <li><i class="bi bi-person"></i> <strong>Pelapor:</strong> <?= htmlspecialchars($r['nama_pelapor']) ?></li>
      <li><i class="bi bi-envelope"></i> <strong>Kontak:</strong> <?= htmlspecialchars($r['kontak']) ?></li>
      <li><i class="bi bi-tag"></i> <strong>Kategori:</strong> <?= htmlspecialchars($r['kategori']) ?></li>
      <li><i class="bi bi-clock"></i> <strong>Tanggal:</strong> <?= date("d M Y H:i", strtotime($r['tanggal'])) ?></li>
    </ul>

    <div class="mt-6 text-emerald-50 leading-relaxed whitespace-pre-line border-t border-emerald-800/30 pt-4">
      <?= nl2br(htmlspecialchars($r['isi_laporan'])) ?>
    </div>

    <div class="mt-6 border-t border-emerald-800/30 pt-4">
      <h3 class="font-semibold text-emerald-300 mb-3 flex items-center gap-2">
        <i class="bi bi-paperclip"></i> Lampiran:
      </h3>

      <?php
      // 🔍 Gunakan path langsung dari database (tanpa ../ atau tambahan)
      if (!empty($r['foto']) && file_exists($r['foto'])) {
          $ext = strtolower(pathinfo($r['foto'], PATHINFO_EXTENSION));

          if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
              echo '<img src="'.htmlspecialchars($r['foto']).'" class="rounded-xl w-full max-h-[480px] object-cover shadow-lg hover:scale-[1.02] transition">';
          } elseif ($ext === 'pdf') {
              echo '<iframe src="'.htmlspecialchars($r['foto']).'" class="w-full h-[500px] rounded-lg border border-emerald-700/50 shadow-md"></iframe>';
          } else {
              echo '<a href="'.htmlspecialchars($r['foto']).'" target="_blank" class="text-emerald-400 hover:text-emerald-200 underline flex items-center gap-2"><i class="bi bi-file-earmark-arrow-down"></i> Lihat Lampiran</a>';
          }
      } elseif (!empty($r['video']) && file_exists($r['video'])) {
          echo '<video controls class="w-full rounded-xl max-h-[480px] shadow-lg"><source src="'.htmlspecialchars($r['video']).'"></video>';
      } else {
          echo '<p class="text-gray-400 italic">Tidak ada lampiran.</p>';
      }
      ?>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
