<?php
include 'header.php';
include_once(__DIR__ . '/../config/config.php');

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
  echo "<script>alert('ID tidak valid');window.location='struktur.php';</script>";
  exit;
}

$stmt = $conn->prepare("SELECT * FROM struktur_pemerintahan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
  echo "<script>alert('Data tidak ditemukan');window.location='struktur.php';</script>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama']);
  $jabatan = trim($_POST['jabatan']);
  $urutan = intval($_POST['urutan']);
  $newFoto = $data['foto'];

  $folder = __DIR__ . '/../uploads/';
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  if (!empty($_FILES['foto']['name'])) {
    $namaFile = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $_FILES['foto']['name']);
    $target = $folder . $namaFile;
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
      if (!empty($data['foto'])) {
        $oldPath = __DIR__ . '/../' . $data['foto'];
        if (file_exists($oldPath)) unlink($oldPath);
      }
      $newFoto = 'uploads/' . $namaFile;
    }
  }

  $stmt2 = $conn->prepare("UPDATE struktur_pemerintahan SET nama=?, jabatan=?, urutan=?, foto=? WHERE id=?");
  $stmt2->bind_param("ssisi", $nama, $jabatan, $urutan, $newFoto, $id);
  if ($stmt2->execute()) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      Swal.fire({
        icon:'success',
        title:'Berhasil!',
        text:'Data struktur berhasil diperbarui.',
        timer:1400, showConfirmButton:false,
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      }).then(()=> window.location='struktur.php');
    </script>";
  } else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      Swal.fire({
        icon:'error', title:'Gagal!',
        text:'Terjadi kesalahan saat memperbarui data.',
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      });
    </script>";
  }
  $stmt2->close();
}
?>

<div class="relative z-10 max-w-3xl mx-auto px-6 py-12">
  <h2 class="text-4xl font-extrabold text-emerald-300 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.35)] mb-8" data-aos="zoom-in">
    <i class="bi bi-pencil-square text-emerald-400 animate-pulse"></i>
    Edit Struktur Pemerintahan
  </h2>

  <form method="post" enctype="multipart/form-data"
        class="bg-[#0f241c]/80 border border-emerald-600/30 rounded-2xl p-6 md:p-8 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.12)] hover:shadow-[0_0_40px_rgba(0,255,150,0.2)] transition-all space-y-5"
        data-aos="fade-up">

    <!-- Nama -->
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Nama Lengkap</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required
             class="w-full lapor-input" placeholder="Masukkan nama lengkap...">
    </div>

    <!-- Jabatan -->
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Jabatan</label>
      <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>" required
             class="w-full lapor-input" placeholder="Masukkan jabatan...">
    </div>

    <!-- Urutan -->
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Urutan Hierarki</label>
      <input type="number" name="urutan" value="<?= htmlspecialchars($data['urutan']); ?>" required
             class="w-full lapor-input" placeholder="Contoh: 1">
    </div>

    <!-- Foto Saat Ini -->
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Foto Saat Ini</label>
      <?php
      $path = (!empty($data['foto']) && file_exists(__DIR__ . '/../' . $data['foto']))
                ? '../' . $data['foto']
                : 'https://via.placeholder.com/400x250?text=No+Image';
      ?>
      <img src="<?= $path ?>" class="w-full max-h-80 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_12px_rgba(16,185,129,.4)] mb-3">
    </div>

    <!-- Ganti Foto -->
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Ganti Foto (Opsional)</label>
      <label class="upload-btn">
        <i class="bi bi-image"></i> Pilih Gambar Baru
        <input type="file" name="foto" accept="image/*" class="hidden" id="fileInput">
      </label>

      <div id="previewWrap" class="hidden mt-3">
        <img id="previewImg" class="w-full max-h-80 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_12px_rgba(16,185,129,.4)]">
        <div class="w-full bg-emerald-900/40 rounded-full h-2 mt-2 overflow-hidden">
          <div id="progressBar" class="h-2 w-0 bg-emerald-400"></div>
        </div>
      </div>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-3">
      <a href="struktur.php"
         class="px-4 py-2 rounded-lg bg-emerald-900/40 hover:bg-emerald-900/60 text-emerald-100 transition">Batal</a>
      <button type="submit"
              class="px-6 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all">
        Perbarui
      </button>
    </div>
  </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: true });</script>
<script>
const fi = document.getElementById('fileInput');
const wrap = document.getElementById('previewWrap');
const img  = document.getElementById('previewImg');
const bar  = document.getElementById('progressBar');

fi?.addEventListener('change', e=>{
  const f = e.target.files[0];
  if(!f) return;
  const reader = new FileReader();
  reader.onload = ev=>{
    img.src = ev.target.result;
    wrap.classList.remove('hidden');
    bar.style.width = '0%';
    let p=0; const t=setInterval(()=>{ p+=4; bar.style.width=p+'%'; if(p>=100) clearInterval(t); }, 30);
  };
  reader.readAsDataURL(f);
});
</script>

<style>
.lapor-input{
  background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15);
  color:#eaffea; border-radius:.8rem; padding:.8rem 1rem; outline:none;
  transition:.25s; width:100%;
}
.lapor-input::placeholder{ color:#cde8d2a6 }
.lapor-input:focus{ border-color:#22c55e; box-shadow:0 0 12px rgba(34,197,94,.4); transform:translateY(-1px) }
.upload-btn{
  display:inline-flex; align-items:center; gap:.6rem; padding:.75rem 1.1rem;
  border-radius:.8rem; color:#fff; cursor:pointer; transition:.25s;
  background:linear-gradient(90deg,#065f46,#10b981); box-shadow:0 0 12px rgba(16,185,129,.45)
}
.upload-btn:hover{ transform:translateY(-1px) scale(1.02); box-shadow:0 0 22px rgba(16,185,129,.75) }
</style>

<?php include 'footer.php'; ?>
