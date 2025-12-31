<?php
include 'header.php';
include_once('../config/config.php');

if (isset($_POST['simpan'])) {
  $judul = trim($_POST['judul'] ?? '');
  $isi = trim(str_replace(array("\r\n", "\r", "\n"), "\n", $_POST['isi'] ?? ''));
  $tanggal = date('Y-m-d');
  $foto = '';

  $dir = __DIR__ . '/../uploads/';
  if (!is_dir($dir)) mkdir($dir, 0777, true);

  if (!empty($_FILES['foto']['name'])) {
    $safe = time().'_'.preg_replace('/[^a-zA-Z0-9_\.-]/','_', basename($_FILES['foto']['name']));
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$safe)) {
      $foto = 'uploads/'.$safe;
    }
  }
  $stmt = $conn->prepare("INSERT INTO berita (judul, isi, tanggal, foto) VALUES (?,?,?,?)");
  $stmt->bind_param('ssss', $judul, $isi, $tanggal, $foto);
  $ok = $stmt->execute(); $stmt->close();

  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
  if ($ok) {
    echo "<script>
      Swal.fire({
        icon:'success', title:'Berhasil', text:'Berita ditambahkan!',
        timer:1300, showConfirmButton:false,
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      }).then(()=> location.href='berita.php');
    </script>";
  } else {
    echo "<script>
      Swal.fire({icon:'error', title:'Gagal', text:'Simpan data gagal.',
        background:'rgba(15,36,28,0.95)', color:'#d1fae5'
      });
    </script>";
  }
}
?>
<div class="relative z-10 max-w-4xl mx-auto px-6 py-12">
  <h2 class="text-4xl font-extrabold text-emerald-300 drop-shadow-[0_0_15px_rgba(0,255,150,0.35)] flex items-center gap-3 mb-8" data-aos="zoom-in">
    <i class="bi bi-plus-circle text-emerald-400 animate-pulse"></i> Tambah Berita
  </h2>

  <form method="post" enctype="multipart/form-data"
        class="bg-[#0f241c]/80 border border-emerald-600/30 rounded-2xl p-6 md:p-8 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.12)] hover:shadow-[0_0_40px_rgba(0,255,150,0.2)] transition-all space-y-5"
        data-aos="fade-up">
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Judul Berita</label>
      <input name="judul" required
             class="w-full lapor-input" placeholder="Judul berita...">
    </div>
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Isi Berita</label>
      <textarea name="isi" rows="8" required class="w-full lapor-input resize-y" placeholder="Tulis isi berita..."></textarea>
    </div>
    <div>
      <label class="block mb-2 font-semibold text-emerald-200">Gambar (Opsional)</label>
      <label class="upload-btn">
        <i class="bi bi-image"></i> Pilih Gambar
        <input type="file" name="foto" accept="image/*" class="hidden" id="fileInput">
      </label>
      <div id="previewWrap" class="hidden mt-3">
        <img id="previewImg" class="w-full max-h-80 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_12px_rgba(16,185,129,.4)]">
        <div class="w-full bg-emerald-900/40 rounded-full h-2 mt-2 overflow-hidden">
          <div id="progressBar" class="h-2 w-0 bg-emerald-400"></div>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3">
      <a href="berita.php" class="px-4 py-2 rounded-lg bg-emerald-900/40 hover:bg-emerald-900/60 text-emerald-100 transition">Batal</a>
      <button name="simpan" class="px-6 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all">
        Simpan Berita
      </button>
    </div>
  </form>
</div>

<script>
AOS.init({ duration: 1000, once:true });

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
