<?php
include('header.php');
include_once('../config/config.php');
?>
<div class="max-w-7xl mx-auto px-6 py-10" data-aos="fade-up">
  <h1 class="text-3xl font-extrabold mb-6 flex items-center gap-3 text-emerald-400">
    <i class="bi bi-clipboard-data-fill text-emerald-500"></i> Daftar Laporan Warga
  </h1>

  <div class="overflow-x-auto rounded-2xl shadow-[0_0_25px_rgba(16,185,129,0.2)] border border-emerald-700/30 backdrop-blur-md bg-[#0f241c]/80 dark:bg-[#0f241c]/90">
    <table class="min-w-full text-sm">
      <thead class="bg-emerald-700 text-white text-left">
        <tr>
          <th class="px-4 py-3">Nama Pelapor</th>
          <th class="px-4 py-3">Judul</th>
          <th class="px-4 py-3">Kategori</th>
          <th class="px-4 py-3 text-center">Lampiran</th>
          <th class="px-4 py-3 text-center">Status</th>
          <th class="px-4 py-3 text-center">Tanggal</th>
          <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-emerald-800/20">
        <?php
        $q = $conn->query("SELECT * FROM laporan ORDER BY id DESC");
        if ($q && $q->num_rows > 0):
          while($r = $q->fetch_assoc()):
            $map = [
              'Infrastruktur' => ['bi-tools', '#ff9800'],
              'Lingkungan' => ['bi-tree', '#4caf50'],
              'Keamanan' => ['bi-shield-check', '#1e88e5'],
              'Sosial' => ['bi-people', '#9c27b0']
            ];
            $icon = $map[$r['kategori']][0] ?? 'bi-tag';
            $color = $map[$r['kategori']][1] ?? '#6b7280';
            $statusColor = [
              'baru' => 'bg-amber-200/80 text-amber-900',
              'diproses' => 'bg-blue-200/80 text-blue-900',
              'selesai' => 'bg-green-200/80 text-green-900'
            ][$r['status'] ?? 'baru'];
        ?>
        <tr class="hover:bg-emerald-800/10 transition-all">
          <td class="px-4 py-3 font-semibold text-emerald-100"><?= htmlspecialchars($r['nama_pelapor']) ?></td>
          <td class="px-4 py-3 text-emerald-50"><?= htmlspecialchars($r['judul_laporan']) ?></td>
          <td class="px-4 py-3 flex items-center gap-2 text-emerald-200">
            <i class="bi <?= $icon ?>" style="color:<?= $color ?>"></i>
            <?= htmlspecialchars($r['kategori']) ?>
          </td>
          <td class="px-4 py-3 text-center">
            <?php
              $lampiran = $r['foto'] ?: $r['video'];
              if ($lampiran):
                $ext = strtolower(pathinfo($lampiran, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                $isVideo = in_array($ext, ['mp4','mov','avi','webm','mkv']);
                $type = $isImage ? 'Gambar' : ($isVideo ? 'Video' : 'File');
                $color = $isImage ? 'text-green-400' : ($isVideo ? 'text-blue-400' : 'text-yellow-400');
            ?>
              <a href="<?= htmlspecialchars($lampiran) ?>" target="_blank" class="<?= $color ?> hover:underline"><?= $type ?></a>
            <?php else: ?><span class="text-gray-500">-</span><?php endif; ?>
          </td>
          <td class="px-4 py-3 text-center">
            <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $statusColor ?>"><?= strtoupper($r['status']) ?></span>
          </td>
          <td class="px-4 py-3 text-center text-emerald-100"><?= date("d M Y H:i", strtotime($r['tanggal'])) ?></td>
          <td class="px-4 py-3 text-center">
            <div class="flex justify-center gap-2">
              <a href="laporan_detail.php?id=<?= $r['id'] ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg shadow transition" title="Lihat Detail">
                <i class="bi bi-eye"></i>
              </a>
              <button data-id="<?= $r['id'] ?>" data-status="diproses" class="btn-status bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg shadow transition" title="Tandai Diproses">
                <i class="bi bi-gear-fill"></i>
              </button>
              <button data-id="<?= $r['id'] ?>" data-status="selesai" class="btn-status bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg shadow transition" title="Tandai Selesai">
                <i class="bi bi-check2-circle"></i>
              </button>
            </div>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="7" class="text-center py-6 text-gray-400 italic">Belum ada laporan warga.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
AOS.init({ duration: 1000, once:true });

document.querySelectorAll(".btn-status").forEach(btn => {
  btn.addEventListener("click", async () => {
    const id = btn.dataset.id, status = btn.dataset.status;
    const {isConfirmed} = await Swal.fire({
      icon: 'question', title: 'Ubah Status?',
      text: `Tandai laporan sebagai ${status.toUpperCase()}?`,
      showCancelButton: true, confirmButtonText: 'Ya, ubah',
      confirmButtonColor: '#059669', cancelButtonColor: '#9ca3af'
    });
    if(!isConfirmed) return;

    const res = await fetch('laporan_update_status.php', {
      method: 'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body: new URLSearchParams({id, status})
    });
    const data = await res.json();
    if(data.ok){
      Swal.fire({icon:'success', title:'Status diperbarui!', timer:1300, showConfirmButton:false});
      setTimeout(()=>location.reload(),1000);
    } else {
      Swal.fire({icon:'error', title:'Gagal', text:data.msg});
    }
  });
});
</script>
<?php include('footer.php'); ?>
