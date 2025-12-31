<?php
include('header.php');
include_once('../config/config.php');
?>
<div class="relative z-10 max-w-6xl mx-auto px-6 py-12">
  <!-- Judul -->
  <div class="mb-8 flex items-center justify-between">
    <div>
      <h2 class="text-4xl font-extrabold text-emerald-300 drop-shadow-[0_0_15px_rgba(0,255,150,0.35)] flex items-center gap-3" data-aos="zoom-in">
        <i class="bi bi-newspaper text-emerald-400 animate-pulse"></i>
        Kelola Berita
      </h2>
      <p class="text-emerald-100/80 mt-2">Tambah, ubah, atau hapus berita kelurahan.</p>
    </div>
    <a href="tambah_berita.php"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white font-medium shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all"
       data-aos="fade-left">
      <i class="bi bi-plus-lg"></i> Tambah Berita
    </a>
  </div>

  <!-- Tabel -->
  <div class="p-6 md:p-8 rounded-2xl bg-[#0f241c]/80 border border-emerald-600/30 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.12)] hover:shadow-[0_0_40px_rgba(0,255,150,0.2)] transition-all" data-aos="zoom-in-up">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-emerald-50 table-auto">
        <thead class="bg-emerald-700/80 text-white">
          <tr>
            <th class="text-left py-3 px-4 w-[62%]">Judul</th>
            <th class="text-left py-3 px-4 w-[18%]">Tanggal</th>
            <th class="text-center py-3 px-4 w-[20%]">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-emerald-900/40">
          <?php
          $q = $conn->query("SELECT id, judul, tanggal FROM berita ORDER BY id DESC");
          if($q && $q->num_rows):
            while($r = $q->fetch_assoc()):
          ?>
          <tr class="hover:bg-emerald-800/20 transition-all duration-300">
            <td class="py-3 px-4 font-medium text-emerald-200">
              <?= htmlspecialchars($r['judul']) ?>
            </td>
            <td class="py-3 px-4 text-emerald-100/80">
              <?= htmlspecialchars($r['tanggal']) ?>
            </td>
            <td class="py-3 px-2">
              <div class="flex justify-center gap-3">
                <a href="edit_berita.php?id=<?= $r['id'] ?>"
                   class="btn-action btn-edit" data-tooltip="Edit Berita">
                  <span class="relative z-10 flex items-center gap-[6px] font-semibold">
                    <i class="bi bi-pencil-fill"></i><span>Edit</span>
                  </span>
                  <span class="action-glow"></span>
                </a>
                <button class="btn-action btn-delete btn-hapus"
                        data-id="<?= $r['id'] ?>"
                        data-href="hapus_berita.php?id=<?= $r['id'] ?>"
                        data-tooltip="Hapus Berita">
                  <span class="relative z-10 flex items-center gap-[6px] font-semibold">
                    <i class="bi bi-trash3-fill"></i><span>Hapus</span>
                  </span>
                  <span class="action-glow"></span>
                </button>
              </div>
            </td>
          </tr>
          <?php endwhile; else: ?>
          <tr>
            <td colspan="3" class="py-6 text-center text-emerald-100/70 italic">
              Belum ada berita.
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Interaksi -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
AOS.init({ duration: 1000, once: true });

document.querySelectorAll('.btn-hapus').forEach(btn => {
  btn.addEventListener('click', async () => {
    const id = btn.dataset.id;
    const href = btn.dataset.href;

    const {isConfirmed} = await Swal.fire({
      title: 'Hapus Berita?',
      text: 'Data akan dihapus permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#10b981',
      background: 'rgba(15,36,28,0.95)',
      color: '#d1fae5'
    });
    if (!isConfirmed) return;

    try {
      const res = await fetch('hapus_berita.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({id})
      });
      if (res.ok) {
        const data = await res.text().catch(()=> '');
        // Jika server tidak balas JSON, tetap tampilkan sukses
        await Swal.fire({
          icon: 'success', title: 'Terhapus!', timer: 1200, showConfirmButton: false,
          background: 'rgba(15,36,28,0.95)', color: '#d1fae5'
        });
        location.reload();
      } else {
        // fallback ke GET bila POST tidak didukung
        location.href = href;
      }
    } catch (e) {
      // fallback ke GET
      location.href = href;
    }
  });
});
</script>

<style>
/* Tombol aksi aurora */
.btn-action{
  position:relative; overflow:hidden; border-radius:9999px;
  padding:.5rem .9rem; font-size:.8rem; font-weight:600; color:#fff;
  display:inline-flex; align-items:center; justify-content:center;
  border:1px solid transparent; transition:.25s ease;
  min-width:92px; white-space:nowrap;
}
.btn-action:hover{ transform:translateY(-2px) }
.btn-edit{
  background:linear-gradient(90deg,#1e40af 0%,#2563eb 100%);
  box-shadow:0 0 12px rgba(37,99,235,.45)
}
.btn-edit:hover{ box-shadow:0 0 24px rgba(37,99,235,.75) }
.btn-delete{
  background:linear-gradient(90deg,#b91c1c 0%,#dc2626 100%);
  box-shadow:0 0 12px rgba(239,68,68,.45);
  animation:pulseRed 2.6s infinite;
}
.btn-delete:hover{ box-shadow:0 0 24px rgba(239,68,68,.75) }

.action-glow{
  content:""; position:absolute; inset:0;
  background:linear-gradient(120deg,transparent 0%,rgba(255,255,255,.18) 50%,transparent 100%);
  transform:translateX(-100%); transition:all .6s ease;
}
.btn-action:hover .action-glow{ transform:translateX(100%) }

/* Tooltip glow */
.btn-action::after{
  content:attr(data-tooltip); position:absolute; bottom:130%; left:50%;
  transform:translateX(-50%) translateY(6px);
  background:rgba(20,83,45,.95); color:#d1fae5; padding:6px 10px; font-size:.72rem;
  border-radius:6px; white-space:nowrap; opacity:0; pointer-events:none; transition:.3s ease;
  box-shadow:0 0 12px rgba(16,185,129,.55)
}
.btn-action:hover::after{ opacity:1; transform:translateX(-50%) translateY(-2px) }

@keyframes pulseRed{
  0%,100%{ box-shadow:0 0 12px rgba(239,68,68,.45) }
  50%{ box-shadow:0 0 20px rgba(239,68,68,.8) }
}
</style>
<?php include('footer.php'); ?>
