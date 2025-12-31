<?php
include 'header.php';
include_once('../config/config.php');

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
  echo "<script>Swal.fire('Error','ID potensi tidak valid!','error').then(()=>location.href='potensi.php');</script>";
  exit;
}

$res = $conn->query("SELECT * FROM potensi WHERE id=$id");
if (!$res || $res->num_rows === 0) {
  echo "<script>Swal.fire('Error','Data potensi tidak ditemukan!','error').then(()=>location.href='potensi.php');</script>";
  exit;
}

$data = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = $conn->real_escape_string($_POST['judul']);
  $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
  $foto = $data['foto'];

  if (!empty($_FILES['foto']['name'])) {
    $dir = __DIR__ . '/../uploads/';
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    $nama = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $nama);
    if (!empty($foto) && file_exists(__DIR__ . '/../' . $foto)) unlink(__DIR__ . '/../' . $foto);
    $foto = 'uploads/' . $nama;
  }

  $conn->query("UPDATE potensi SET judul='$judul', deskripsi='$deskripsi', foto='$foto' WHERE id=$id");
  echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Potensi Diperbarui!',
      showConfirmButton: false,
      timer: 1200,
      background: 'rgba(15,36,28,0.9)',
      color: '#d1fae5'
    }).then(() => location.href='potensi.php');
  </script>";
  exit;
}
?>

<div class="relative z-10 max-w-4xl mx-auto px-8 py-12">
  <h2 class="text-3xl font-extrabold text-emerald-300 mb-10 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)]" data-aos="zoom-in">
    <i class="bi bi-pencil-square text-emerald-400 animate-pulse"></i> Edit Potensi Kelurahan
  </h2>

  <div class="relative p-10 rounded-2xl bg-[#0f241c]/90 border border-emerald-600/40 backdrop-blur-xl 
              shadow-[0_0_60px_rgba(0,255,150,0.2)] hover:shadow-[0_0_80px_rgba(0,255,150,0.35)] 
              transition-all duration-700 overflow-hidden" data-aos="zoom-in-up">
    <div class="absolute inset-0 pointer-events-none rounded-2xl border border-emerald-400/20 shadow-inner"></div>

    <form method="POST" enctype="multipart/form-data" class="relative z-10 space-y-6">
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Judul</label>
        <input type="text" name="judul" required value="<?= htmlspecialchars($data['judul']) ?>"
               class="w-full p-3 rounded-lg border border-emerald-600/30 bg-[#0f241c]/60 text-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-inner">
      </div>

      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Isi / Deskripsi</label>
        <textarea name="deskripsi" rows="7" required
                  class="w-full p-3 rounded-lg border border-emerald-600/30 bg-[#0f241c]/60 text-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-inner"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
      </div>

      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Foto</label>
        <?php if (!empty($data['foto'])): ?>
          <img src="../<?= $data['foto']; ?>" class="w-full max-h-64 object-cover rounded-lg mb-3 shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:scale-[1.02] transition-all duration-500">
        <?php endif; ?>

        <!-- Custom File Input seperti Tambah Potensi -->
        <div class="relative group cursor-pointer">
          <input type="file" name="foto" id="fotoInput" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20" />
          <div class="flex items-center justify-center w-full p-3 border border-emerald-600/40 rounded-lg bg-[#0f241c]/70 text-emerald-200 transition-all duration-300 hover:bg-emerald-700/20 hover:shadow-[0_0_15px_rgba(16,185,129,0.4)]">
            <i class="bi bi-cloud-arrow-up-fill text-emerald-400 text-lg mr-2"></i>
            <span id="fileName">Pilih File Gambar</span>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/20 via-transparent to-emerald-700/10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-700"></div>
        </div>

        <div id="preview" class="mt-4 hidden">
          <img id="previewImg" src="" class="w-full max-h-64 object-cover rounded-lg shadow-lg border border-emerald-600/30">
          <div class="w-full bg-emerald-900/30 rounded-full mt-2 h-2">
            <div id="progressBar" class="bg-emerald-500 h-2 rounded-full w-0 transition-all duration-300"></div>
          </div>
        </div>
      </div>

      <div class="flex justify-end gap-4 pt-4">
        <a href="potensi.php"
           class="btn-action btn-cancel">
          <i class="bi bi-x-circle"></i> Batal
          <span class="action-glow"></span>
        </a>
        <button type="submit"
                class="btn-action btn-save">
          <i class="bi bi-check-circle"></i> Perbarui
          <span class="action-glow"></span>
        </button>
      </div>
    </form>
  </div>
</div>

<script>
AOS.init({ duration: 1100, once: true, easing: 'ease-in-out-back' });

// Menampilkan nama file + preview upload
const input = document.getElementById('fotoInput');
const fileName = document.getElementById('fileName');
const preview = document.getElementById('preview');
const previewImg = document.getElementById('previewImg');
const bar = document.getElementById('progressBar');

input.addEventListener('change', e => {
  const file = e.target.files[0];
  if (!file) return;
  fileName.textContent = file.name;
  const reader = new FileReader();
  reader.onload = ev => {
    previewImg.src = ev.target.result;
    preview.classList.remove('hidden');
    bar.style.width = '0%';
    let progress = 0;
    const interval = setInterval(() => {
      progress += 5;
      bar.style.width = progress + '%';
      if (progress >= 100) clearInterval(interval);
    }, 50);
  };
  reader.readAsDataURL(file);
});
</script>

<style>
/* Tombol Aurora Reusable */
.btn-action {
  position: relative;
  overflow: hidden;
  border-radius: 9999px;
  padding: 0.6rem 1.2rem;
  font-size: 0.8rem;
  font-weight: 600;
  white-space: nowrap;
  color: #fff;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.45rem;
  border: 1px solid transparent;
}

.btn-save {
  background: linear-gradient(90deg, #047857 0%, #10b981 100%);
  box-shadow: 0 0 12px rgba(16,185,129,0.4);
}
.btn-save:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 0 25px rgba(16,185,129,0.7);
}
.btn-cancel {
  background: linear-gradient(90deg, #b91c1c 0%, #dc2626 100%);
  box-shadow: 0 0 12px rgba(239,68,68,0.4);
}
.btn-cancel:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 0 25px rgba(239,68,68,0.7);
}

/* Efek Glow Bergerak */
.action-glow {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.15) 50%, transparent 100%);
  transform: translateX(-100%);
  transition: all 0.6s ease;
}
.btn-action:hover .action-glow { transform: translateX(100%); }
</style>

<?php include 'footer.php'; ?>