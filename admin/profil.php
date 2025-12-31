<?php
include('header.php'); 
include_once('../config/config.php');

// CREATE / UPDATE
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $id    = intval($_POST['id'] ?? 0);
  $judul = $conn->real_escape_string($_POST['judul']);
  $isi   = $conn->real_escape_string($_POST['isi']);

  if ($id>0) {
    $ok = $conn->query("UPDATE profil_desa SET judul='$judul', isi='$isi' WHERE id=$id");
    echo "<script>Swal.fire({icon:'success',title:'Profil diperbarui',showConfirmButton:false,timer:1500}).then(()=>location.href='profil.php')</script>"; exit;
  } else {
    $ok = $conn->query("INSERT INTO profil_desa (judul, isi) VALUES ('$judul','$isi')");
    echo "<script>Swal.fire({icon:'success',title:'Profil ditambahkan',showConfirmButton:false,timer:1500}).then(()=>location.href='profil.php')</script>"; exit;
  }
}

// DELETE
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  $conn->query("DELETE FROM profil_desa WHERE id=$id");
  echo "<script>Swal.fire({icon:'success',title:'Profil dihapus',showConfirmButton:false,timer:1500}).then(()=>location.href='profil.php')</script>"; exit;
}

// DATA
$list = $conn->query("SELECT * FROM profil_desa ORDER BY id DESC");
$edit = null;
if (isset($_GET['edit'])) {
  $eid  = intval($_GET['edit']);
  $eRes = $conn->query("SELECT * FROM profil_desa WHERE id=$eid");
  $edit = $eRes ? $eRes->fetch_assoc() : null;
}
?>

<div class="relative z-10 max-w-6xl mx-auto px-6 py-12">
  <!-- Header -->
  <h2 class="text-4xl font-extrabold text-emerald-300 mb-10 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)]" data-aos="fade-down">
    <i class="bi bi-info-circle-fill text-emerald-400"></i> Profil Kelurahan
  </h2>

  <div class="grid lg:grid-cols-2 gap-8">
    <!-- Form Profil -->
    <div class="p-8 rounded-2xl bg-[#0f241c]/80 border border-emerald-600/30 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.1)] hover:shadow-[0_0_40px_rgba(0,255,150,0.2)] transition-all duration-500" data-aos="fade-right">
      <h3 class="text-lg font-semibold text-emerald-300 mb-5 flex items-center gap-2">
        <i class="bi bi-pencil-square"></i> <?= $edit ? 'Edit Profil Kelurahan' : 'Tambah Profil Baru' ?>
      </h3>

      <form method="post" class="space-y-5">
        <?php if($edit): ?><input type="hidden" name="id" value="<?= $edit['id'] ?>"><?php endif; ?>

        <div>
          <label class="block text-sm text-emerald-200 mb-1">Judul</label>
          <input name="judul" required value="<?= htmlspecialchars($edit['judul'] ?? '') ?>"
                 class="w-full rounded-lg p-3 bg-[#102a1d] border border-emerald-600/40 text-emerald-50 placeholder:text-emerald-200/60 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all">
        </div>

        <div>
          <label class="block text-sm text-emerald-200 mb-1">Isi</label>
          <textarea name="isi" rows="6" required
                 class="w-full rounded-lg p-3 bg-[#102a1d] border border-emerald-600/40 text-emerald-50 placeholder:text-emerald-200/60 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition-all"><?= htmlspecialchars($edit['isi'] ?? '') ?></textarea>
        </div>

        <div class="flex items-center gap-3">
          <button class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white font-medium shadow-[0_0_12px_rgba(0,255,150,0.3)] hover:shadow-[0_0_20px_rgba(0,255,150,0.4)] transition-all">
            <i class="bi bi-save2-fill"></i> Simpan
          </button>

          <?php if($edit): ?>
            <a href="profil.php" class="px-4 py-2.5 rounded-lg border border-emerald-500 text-emerald-200 hover:bg-emerald-700/20 transition-all flex items-center gap-2">
              <i class="bi bi-x-circle"></i> Batal
            </a>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <!-- Tabel Profil -->
    <div class="p-8 rounded-2xl bg-[#0f241c]/80 border border-emerald-600/30 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.1)] transition-all duration-500" data-aos="fade-left">
      <h3 class="text-lg font-semibold text-emerald-300 mb-5 flex items-center gap-2">
        <i class="bi bi-journal-text"></i> Daftar Profil Kelurahan
      </h3>

      <div class="rounded-xl border border-emerald-500/20 overflow-hidden">
        <table class="w-full table-fixed text-sm text-emerald-50">
          <thead class="bg-emerald-700/80 text-white">
            <tr>
              <th class="w-[28%] text-left py-3 px-4">Judul</th>
              <th class="w-[52%] text-left py-3 px-4">Isi (Ringkas)</th>
              <th class="w-[20%] text-center py-3 px-4">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-emerald-800/40">
            <?php if($list->num_rows): while($r = $list->fetch_assoc()): ?>
            <tr class="hover:bg-emerald-800/20 transition-all duration-200">
              <td class="py-3 px-4 font-semibold text-emerald-200"><?= htmlspecialchars($r['judul']) ?></td>
              <td class="py-3 px-4 text-emerald-100/80"><?= htmlspecialchars(mb_substr(strip_tags($r['isi']),0,80)) ?>…</td>
              <td class="py-3 px-2 text-center">
                <div class="flex flex-wrap justify-center gap-2">
                  <button data-judul="<?= htmlspecialchars($r['judul']) ?>" data-isi="<?= htmlspecialchars($r['isi']) ?>"
                          class="btn-action btn-preview group" data-tooltip="Preview isi lengkap">
                    <span class="relative z-10 flex items-center gap-1 font-semibold">
                      <i class="bi bi-eye-fill"></i> Preview
                    </span>
                    <span class="action-glow"></span>
                  </button>

                  <a href="profil.php?edit=<?= $r['id'] ?>" class="btn-action btn-edit group" data-tooltip="Edit data profil">
                    <span class="relative z-10 flex items-center gap-1 font-semibold">
                      <i class="bi bi-pencil-fill"></i> Edit
                    </span>
                    <span class="action-glow"></span>
                  </a>

                  <button data-href="profil.php?hapus=<?= $r['id'] ?>" class="btn-action btn-delete group" data-tooltip="Hapus profil">
                    <span class="relative z-10 flex items-center gap-1 font-semibold">
                      <i class="bi bi-trash3-fill"></i> Hapus
                    </span>
                    <span class="action-glow"></span>
                  </button>
                </div>
              </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
              <td colspan="3" class="py-5 text-center text-emerald-200 italic">Belum ada data profil.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- === SCRIPT INTERAKTIF === -->
<script>
AOS.init({ duration: 1000, once: true });

// 🔴 Konfirmasi hapus
document.querySelectorAll('.btn-delete').forEach(btn => {
  btn.addEventListener('click', () => {
    const href = btn.getAttribute('data-href');
    Swal.fire({
      title: 'Hapus Profil?',
      text: 'Data yang dihapus tidak dapat dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#10b981',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then(result => {
      if (result.isConfirmed) window.location.href = href;
    });
  });
});

// 🟢 Preview isi profil (modal kaca transparan)
document.querySelectorAll('.btn-preview').forEach(btn => {
  btn.addEventListener('click', () => {
    const judul = btn.dataset.judul;
    const isi = btn.dataset.isi.replace(/\n/g, '<br>');
    Swal.fire({
      title: `<h3 style="color:#6ee7b7">${judul}</h3>`,
      html: `<div style="color:#e2e8f0; text-align:justify; font-size:14px; max-height:300px; overflow-y:auto;">${isi}</div>`,
      background: 'rgba(15,36,28,0.8)',
      color: '#d1fae5',
      showConfirmButton: false,
      showCloseButton: true,
      width: 600,
      backdrop: `rgba(0,0,0,0.8)`
    });
  });
});
</script>

<style>
table { border-collapse: collapse; width: 100%; table-layout: fixed; }
th, td { word-wrap: break-word; overflow-wrap: break-word; }

/* === Tombol Aksi Futuristik === */
.btn-action {
  position: relative;
  overflow: hidden;
  border-radius: 9999px;
  padding: 0.45rem 0.9rem;
  font-size: 0.75rem;
  font-weight: 600;
  white-space: nowrap;
  color: #fff;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: 1px solid transparent;
}

/* Tombol Preview */
.btn-preview {
  background: linear-gradient(90deg, #059669 0%, #10b981 100%);
  box-shadow: 0 0 10px rgba(16,185,129,0.3);
}
.btn-preview:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 0 18px rgba(16,185,129,0.5);
}

/* Tombol Edit */
.btn-edit {
  background: linear-gradient(90deg, #1e3a8a 0%, #2563eb 100%);
  box-shadow: 0 0 10px rgba(37,99,235,0.3);
}
.btn-edit:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 0 18px rgba(37,99,235,0.5);
}

/* Tombol Hapus */
.btn-delete {
  background: linear-gradient(90deg, #b91c1c 0%, #dc2626 100%);
  box-shadow: 0 0 10px rgba(239,68,68,0.3);
  animation: pulseRed 2.5s infinite;
}
.btn-delete:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 0 18px rgba(239,68,68,0.5);
}

/* Efek garis bergerak */
.action-glow {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.15) 50%, transparent 100%);
  transform: translateX(-100%);
  transition: all 0.6s ease;
}
.btn-action:hover .action-glow { transform: translateX(100%); }

/* Animasi pulsasi tombol hapus */
@keyframes pulseRed {
  0%,100% { box-shadow: 0 0 10px rgba(239,68,68,0.3); }
  50% { box-shadow: 0 0 18px rgba(239,68,68,0.5); }
}

/* === Tooltip Glow === */
.btn-action::after {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 130%;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(20, 83, 45, 0.9);
  color: #d1fae5;
  padding: 6px 10px;
  font-size: 0.7rem;
  border-radius: 6px;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s ease;
  box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
}
.btn-action:hover::after {
  opacity: 1;
  transform: translateX(-50%) translateY(-4px);
}
</style>
