<?php
include 'header.php';
include_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = $conn->real_escape_string($_POST['judul']);
  $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
  $foto = '';

  if (!empty($_FILES['foto']['name'])) {
    $dir = __DIR__ . '/../uploads/';
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    $nama = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $nama);
    $foto = 'uploads/' . $nama;
  }

  $conn->query("INSERT INTO potensi (judul, deskripsi, foto) VALUES ('$judul', '$deskripsi', '$foto')");
  echo "<script>Swal.fire({icon:'success',title:'Potensi Ditambahkan',showConfirmButton:false,timer:1500}).then(()=>location.href='potensi.php')</script>";
  exit;
}
?>

<div class="relative z-10 max-w-4xl mx-auto px-6 py-12">
  <h2 class="text-4xl font-extrabold text-emerald-300 mb-10 flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)] animate-pulse" data-aos="fade-right">
    <i class="bi bi-plus-circle-fill text-emerald-400"></i> Tambah Potensi Kelurahan
  </h2>

  <form method="POST" enctype="multipart/form-data"
        class="bg-[#0f241c]/80 p-8 rounded-2xl border border-emerald-700/30 backdrop-blur-xl shadow-[0_0_30px_rgba(0,255,150,0.15)] hover:shadow-[0_0_40px_rgba(0,255,150,0.25)] transition-all duration-700 animate-[fadeIn_1s_ease-in-out]"
        data-aos="fade-up">

    <div>
      <label class="block text-emerald-200 font-medium mb-2">Judul</label>
      <input type="text" name="judul" required
             class="w-full p-3 rounded-lg bg-[#102a1d] border border-emerald-600/50 text-emerald-50 placeholder:text-emerald-200/60 focus:ring-2 focus:ring-emerald-400 focus:outline-none transition-all">
    </div>

    <div class="mt-5">
      <label class="block text-emerald-200 font-medium mb-2">Isi / Deskripsi</label>
      <textarea name="deskripsi" rows="6" required
                class="w-full p-3 rounded-lg bg-[#102a1d] border border-emerald-600/50 text-emerald-50 placeholder:text-emerald-200/60 focus:ring-2 focus:ring-emerald-400 focus:outline-none transition-all"></textarea>
    </div>

    <!-- Upload Foto -->
    <div class="mt-5">
      <label class="block text-emerald-200 font-medium mb-2">Foto</label>

      <div class="relative w-full">
        <input type="file" name="foto" accept="image/*" id="fotoInput" class="hidden">
        <label for="fotoInput"
               id="customFileLabel"
               class="cursor-pointer flex items-center justify-center gap-2 border border-emerald-600/50 text-emerald-100 bg-[#102a1d] rounded-lg py-3 px-4 w-full hover:bg-[#133b2a] hover:text-emerald-50 transition-all duration-300 relative overflow-hidden group">
          <i class="bi bi-cloud-upload-fill text-emerald-400"></i>
          <span>Pilih File Gambar</span>
          <span class="file-glow"></span>
        </label>
      </div>

      <div id="preview" class="mt-4 hidden text-center animate-[fadeIn_0.6s_ease-in-out]">
        <img id="previewImg" src="" class="w-full max-h-72 object-cover rounded-lg shadow-[0_0_20px_rgba(16,185,129,0.3)] transition-all duration-700 transform hover:scale-[1.03]">
        <div class="w-full bg-emerald-950/50 rounded-full mt-3 h-2 overflow-hidden">
          <div id="progressBar" class="bg-emerald-500 h-2 rounded-full w-0 animate-pulse"></div>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3 mt-8">
      <a href="potensi.php"
         class="px-5 py-2.5 rounded-lg border border-emerald-500/60 text-emerald-200 hover:bg-emerald-700/20 hover:text-white transition-all flex items-center gap-2">
         <i class="bi bi-arrow-left-circle"></i> Batal
      </a>

      <button type="submit"
              class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white font-medium shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all flex items-center gap-2">
        <i class="bi bi-save2-fill"></i> Simpan
      </button>
    </div>
  </form>
</div>

<script>
AOS.init({ duration: 1000, once: true, easing: 'ease-out-back' });

// Preview gambar interaktif + label dinamis
const input = document.getElementById('fotoInput');
const label = document.getElementById('customFileLabel');
const preview = document.getElementById('preview');
const img = document.getElementById('previewImg');
const bar = document.getElementById('progressBar');

input.addEventListener('change', e => {
  const file = e.target.files[0];
  if (!file) {
    label.querySelector('span').innerText = "Pilih File Gambar";
    return;
  }
  label.querySelector('span').innerText = "📷 " + file.name;

  const reader = new FileReader();
  reader.onload = ev => {
    img.src = ev.target.result;
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
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Efek glow aurora untuk tombol upload */
#customFileLabel {
  position: relative;
  overflow: hidden;
}
.file-glow {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(120deg, transparent, rgba(16,185,129,0.3), transparent);
  transition: all 0.6s ease;
}
#customFileLabel:hover .file-glow {
  left: 100%;
}

/* Efek fokus input teks */
input:focus, textarea:focus {
  box-shadow: 0 0 10px rgba(16,185,129,0.5);
  transform: scale(1.01);
}

/* Animasi teks judul */
.animate-pulse { animation: pulse 2.5s infinite; }
@keyframes pulse {
  0%,100% { text-shadow: 0 0 10px rgba(16,185,129,0.3); }
  50% { text-shadow: 0 0 25px rgba(16,185,129,0.6); }
}

/* Progress bar halus */
#progressBar {
  transition: width 0.3s ease;
}
</style>

<?php include 'footer.php'; ?>
