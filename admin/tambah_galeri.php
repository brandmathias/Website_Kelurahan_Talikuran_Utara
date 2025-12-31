<?php
include 'header.php';
include_once('../config/config.php');
?>

<div class="relative z-10 max-w-4xl mx-auto px-6 py-12">
  <h2 class="text-4xl font-extrabold text-emerald-300 mb-10 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)]" data-aos="zoom-in">
    <i class="bi bi-cloud-arrow-up-fill text-emerald-400 animate-pulse"></i> Tambah Gambar Galeri
  </h2>

  <div class="p-8 rounded-2xl bg-[#0f241c]/80 border border-emerald-600/30 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.1)] hover:shadow-[0_0_40px_rgba(0,255,150,0.2)] transition-all duration-700">
    <form method="POST" enctype="multipart/form-data" class="space-y-6">
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Judul Gambar</label>
        <input type="text" name="judul" required class="w-full p-3 rounded-lg border border-emerald-600/30 bg-[#0f241c]/60 text-emerald-100 focus:ring-2 focus:ring-emerald-500">
      </div>

      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Upload Gambar</label>
        <div class="relative group cursor-pointer">
          <input type="file" name="foto" id="fotoInput" accept="image/*" required class="absolute inset-0 opacity-0 z-20 cursor-pointer" />
          <div class="flex items-center justify-center w-full p-3 border border-emerald-600/40 rounded-lg bg-[#0f241c]/70 text-emerald-200 transition-all hover:bg-emerald-700/20 hover:shadow-[0_0_15px_rgba(16,185,129,0.4)]">
            <i class="bi bi-upload text-emerald-400 text-lg mr-2"></i>
            <span id="fileName">Pilih File Gambar</span>
          </div>
        </div>

        <div id="preview" class="mt-4 hidden">
          <img id="previewImg" src="" class="w-full max-h-64 object-cover rounded-lg shadow-lg border border-emerald-600/30">
        </div>
      </div>

      <div class="flex justify-end gap-4 pt-4">
        <a href="galeri.php" class="btn-action btn-cancel"><i class="bi bi-x-circle"></i> Batal</a>
        <button type="submit" name="simpan" class="btn-action btn-save"><i class="bi bi-check-circle"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $foto = '';

    $folder = __DIR__ . '/../uploads/';
    if (!file_exists($folder)) mkdir($folder, 0777, true);

    if (!empty($_FILES['foto']['name'])) {
        $namaFile = time() . '_' . basename($_FILES['foto']['name']);
        $target = $folder . $namaFile;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = 'uploads/' . $namaFile;
        }
    }

    $stmt = $conn->prepare("INSERT INTO galeri (judul, foto) VALUES (?, ?)");
    $stmt->bind_param("ss", $judul, $foto);

    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
          icon:'success',
          title:'Berhasil!',
          text:'Gambar berhasil ditambahkan ke galeri.',
          timer:1800,
          showConfirmButton:false,
          background:'rgba(15,36,28,0.9)',
          color:'#d1fae5'
        }).then(()=>window.location='galeri.php');
        </script>";
    } else {
        echo "<script>
        Swal.fire('Gagal','Terjadi kesalahan: ".$stmt->error."','error');
        </script>";
    }
}
?>

<script>
AOS.init({ duration: 1100, once: true, easing: 'ease-in-out-back' });

const input = document.getElementById('fotoInput');
const fileName = document.getElementById('fileName');
const preview = document.getElementById('preview');
const previewImg = document.getElementById('previewImg');

input.addEventListener('change', e => {
  const file = e.target.files[0];
  if (!file) return;
  fileName.textContent = file.name;
  const reader = new FileReader();
  reader.onload = ev => {
    previewImg.src = ev.target.result;
    preview.classList.remove('hidden');
  };
  reader.readAsDataURL(file);
});
</script>

<style>
.btn-action {
  display:inline-flex;align-items:center;gap:.4rem;font-weight:600;color:#fff;
  border-radius:9999px;padding:.6rem 1.2rem;transition:.3s ease;cursor:pointer;
}
.btn-save {background:linear-gradient(90deg,#047857,#10b981);box-shadow:0 0 12px rgba(16,185,129,.4);}
.btn-cancel {background:linear-gradient(90deg,#b91c1c,#dc2626);box-shadow:0 0 12px rgba(239,68,68,.4);}
.btn-save:hover,.btn-cancel:hover{transform:scale(1.05);}
</style>

<?php include 'footer.php'; ?>