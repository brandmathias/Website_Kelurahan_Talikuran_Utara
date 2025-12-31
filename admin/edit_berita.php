<?php
include 'header.php';
include_once(__DIR__ . '/../config/config.php');

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { echo "<script>alert('ID tidak valid');location='berita.php';</script>"; exit; }

$stmt = $conn->prepare("SELECT * FROM berita WHERE id=?");
$stmt->bind_param('i',$id); $stmt->execute();
$data = $stmt->get_result()->fetch_assoc(); $stmt->close();
if (!$data) { echo "<script>alert('Data tidak ditemukan');location='berita.php';</script>"; exit; }

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $judul = $conn->real_escape_string($_POST['judul'] ?? '');
  $isi = trim(str_replace(array("\r\n", "\r", "\n"), "\n", $_POST['isi'] ?? ''));
  $tanggal = date('Y-m-d');

  $dir = __DIR__ . '/../uploads/';
  if (!is_dir($dir)) mkdir($dir,0777,true);

  $newFoto = $data['foto'];
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
      $safe = time().'_'.preg_replace('/[^a-zA-Z0-9_\.-]/','_', basename($_FILES['foto']['name']));
      if (move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$safe)) {
        if (!empty($data['foto']) && file_exists(__DIR__.'/../'.$data['foto'])) @unlink(__DIR__.'/../'.$data['foto']);
        $newFoto = 'uploads/'.$safe;
      }
    }
  }
  $up = $conn->prepare("UPDATE berita SET judul=?, isi=?, tanggal=?, foto=? WHERE id=?");
  $up->bind_param('ssssi', $judul, $isi, $tanggal, $newFoto, $id);
  $ok = $up->execute(); $up->close();

  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
  if ($ok) {
    echo "<script>
      Swal.fire({
        icon:'success', title:'Berhasil!',
        text:'Berita berhasil diperbarui.',
        timer:1400, showConfirmButton:false,
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      }).then(()=> location.href='berita.php');
    </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon:'error', title:'Gagal!',
        text:'Terjadi kesalahan saat update.',
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      });
    </script>";
  }
}
?>

<div class="relative z-10 max-w-4xl mx-auto px-5 py-12">
  <!-- Header -->
  <div class="mb-8" data-aos="fade-down">
    <h2 class="text-4xl font-extrabold text-emerald-300 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.35)]">
      <i class="bi bi-pencil-square text-emerald-400 animate-pulse"></i> Edit Berita
    </h2>
    <p class="text-emerald-200/80 mt-2 text-sm">Perbarui konten berita dan ganti gambar bila diperlukan.</p>
  </div>

  <!-- Card -->
  <form method="post" enctype="multipart/form-data"
        class="bg-[#0f241c]/90 rounded-2xl p-8 border border-emerald-700/40 backdrop-blur-xl shadow-[0_0_25px_rgba(16,185,129,0.2)] transition-all"
        data-aos="fade-up">
    
    <!-- Judul -->
    <div class="mb-5">
      <label class="block mb-2 font-semibold text-emerald-200">Judul Berita</label>
      <input name="judul" required
             value="<?php echo htmlspecialchars($data['judul']); ?>"
             class="lapor-input" placeholder="Masukkan judul berita...">
    </div>

    <!-- Isi -->
    <div class="mb-8">
      <label class="block mb-2 font-semibold text-emerald-200">Isi Berita</label>
      <textarea name="isi" rows="8" required
                class="lapor-input resize-y"
                placeholder="Tulis isi berita di sini..."><?php echo htmlspecialchars($data['isi']); ?></textarea>
    </div>

    <!-- Bagian Foto -->
    <div class="space-y-6">
      <!-- Foto Saat Ini -->
      <div class="p-4 rounded-xl bg-emerald-900/25 border border-emerald-700/40">
        <label class="block mb-3 font-semibold text-emerald-200">Foto Saat Ini</label>
        <?php
          $exists = !empty($data['foto']) && file_exists(__DIR__.'/../'.$data['foto']);
          $src = $exists ? '../'.$data['foto'] : 'https://via.placeholder.com/800x400?text=Tidak+Ada+Foto';
        ?>
        <img src="<?php echo $src; ?>" alt="Foto berita"
             class="w-full h-64 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:scale-[1.02] transition-transform duration-500">
      </div>

      <!-- Upload Baru -->
      <div class="p-4 rounded-xl bg-emerald-900/25 border border-emerald-700/40">
        <label class="block mb-3 font-semibold text-emerald-200">Ganti Foto (Opsional)</label>
        <label class="upload-btn w-full justify-center">
          <i class="bi bi-image"></i> Pilih Gambar Baru
          <input type="file" name="foto" accept="image/*" class="hidden" id="fileInput">
        </label>

        <div id="previewWrap" class="hidden mt-4">
          <img id="previewImg"
               class="w-full h-64 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_12px_rgba(16,185,129,.4)] transition-transform duration-500 hover:scale-[1.02]">
          <div class="w-full bg-emerald-900/40 rounded-full h-2 mt-2 overflow-hidden">
            <div id="progressBar" class="h-2 w-0 bg-emerald-400"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-3 mt-8">
      <a href="berita.php"
         class="px-5 py-2.5 rounded-lg bg-emerald-900/40 hover:bg-emerald-900/60 text-emerald-100 transition">
         Batal
      </a>
      <button
        class="px-6 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all">
        Perbarui
      </button>
    </div>
  </form>
</div>

<script>
AOS.init({ duration: 1000, once:true });
const fi=document.getElementById('fileInput');
const wrap=document.getElementById('previewWrap');
const img=document.getElementById('previewImg');
const bar=document.getElementById('progressBar');
fi?.addEventListener('change',e=>{
  const f=e.target.files[0]; if(!f) return;
  const reader=new FileReader();
  reader.onload=ev=>{
    img.src=ev.target.result;
    wrap.classList.remove('hidden');
    bar.style.width='0%';
    let p=0; const t=setInterval(()=>{p+=3; bar.style.width=p+'%'; if(p>=100) clearInterval(t);},25);
  };
  reader.readAsDataURL(f);
});
</script>

<style>
.lapor-input{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.15);
  color:#eaffea;
  border-radius:.8rem;
  padding:.8rem 1rem;
  outline:none;
  transition:.25s;
  width:100%;
}
.lapor-input::placeholder{ color:#cde8d2a6 }
.lapor-input:focus{
  border-color:#22c55e;
  box-shadow:0 0 12px rgba(34,197,94,.4);
  transform:translateY(-1px);
}
.upload-btn{
  display:flex; align-items:center; gap:.6rem; padding:.8rem 1rem;
  border-radius:.8rem; color:#fff; cursor:pointer; transition:.25s;
  background:linear-gradient(90deg,#065f46,#10b981);
  box-shadow:0 0 12px rgba(16,185,129,.45);
}
.upload-btn:hover{
  transform:translateY(-1px) scale(1.02);
  box-shadow:0 0 22px rgba(16,185,129,.75);
}
</style>

<?php include 'footer.php'; ?>
