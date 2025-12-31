<?php 
include 'header.php'; 
include_once(__DIR__ . '/../config/config.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Struktur Pemerintahan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#03140d] min-h-screen p-6 font-[Poppins] text-emerald-50">

  <!-- Header -->
  <div class="mb-10 text-center" data-aos="fade-down">
    <h2 class="text-4xl font-bold text-emerald-300 flex items-center justify-center gap-2 drop-shadow-[0_0_15px_rgba(16,185,129,0.6)]">
      <i class="bi bi-person-plus-fill text-emerald-400 animate-pulse"></i>
      Tambah Struktur Pemerintahan
    </h2>
  </div>

  <!-- Form Container -->
  <div class="max-w-2xl mx-auto bg-[#062015] rounded-2xl p-8 border border-emerald-700/40 shadow-[0_0_40px_rgba(0,255,150,0.1)]" data-aos="zoom-in">
    <form action="" method="post" enctype="multipart/form-data" class="space-y-5">

      <!-- Nama -->
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Nama Lengkap</label>
        <input type="text" name="nama" required
               class="w-full bg-transparent border border-emerald-700/40 rounded-lg p-3 text-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-emerald-400/40">
      </div>

      <!-- Jabatan -->
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Jabatan</label>
        <input type="text" name="jabatan" required
               class="w-full bg-transparent border border-emerald-700/40 rounded-lg p-3 text-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-emerald-400/40">
      </div>

      <!-- Urutan -->
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Urutan Hierarki</label>
        <input type="number" name="urutan" value="0" required
               class="w-full bg-transparent border border-emerald-700/40 rounded-lg p-3 text-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-emerald-400/40">
      </div>

      <!-- Foto -->
      <div>
        <label class="block text-emerald-300 mb-2 font-semibold">Foto Profil (Opsional)</label>
        <div class="border border-emerald-700/40 rounded-lg p-4 flex flex-col items-center justify-center hover:bg-emerald-900/10 transition relative">
          <label for="foto" class="cursor-pointer flex items-center gap-2 text-emerald-200 hover:text-emerald-100 transition">
            <i class="bi bi-upload text-lg"></i> Pilih File Gambar
          </label>
          <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="previewImage(event)">
          <img id="preview" class="hidden mt-4 rounded-lg border border-emerald-700/50 shadow-[0_0_15px_rgba(16,185,129,0.3)] w-32 h-32 object-cover" alt="Preview Gambar">
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-4">
        <a href="struktur.php" 
           class="px-5 py-2 rounded-lg bg-emerald-700/30 hover:bg-emerald-700/50 text-emerald-100 flex items-center gap-2 border border-emerald-600/40 transition">
           <i class="bi bi-arrow-left-circle"></i> Batal
        </a>
        <button type="submit" name="simpan"
                class="px-5 py-2 rounded-lg bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white font-semibold flex items-center gap-2 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)] transition">
          <i class="bi bi-save"></i> Simpan Struktur
        </button>
      </div>
    </form>
  </div>

  <!-- SCRIPT: Preview Gambar -->
  <script>
  function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      preview.classList.add('hidden');
    }
  }

  AOS.init({ duration: 800, once: true });
  </script>

</body>
</html>

<?php
// === PROSES PENYIMPANAN DATA ===
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $urutan = intval($_POST['urutan']);
  $foto = '';

  // Pastikan folder upload tersedia
  $folder = realpath(__DIR__ . '/../uploads');
  if (!$folder) {
    mkdir(__DIR__ . '/../uploads', 0777, true);
    $folder = realpath(__DIR__ . '/../uploads');
  }

  // Upload foto jika ada
  if (!empty($_FILES['foto']['name'])) {
    $namaFile = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $_FILES['foto']['name']);
    $target = $folder . DIRECTORY_SEPARATOR . $namaFile;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
      $foto = 'uploads/' . $namaFile;
    } else {
      echo "<script>
        Swal.fire({ icon: 'error', title: 'Gagal Upload!', text: 'Gagal memindahkan file.', background:'#062015', color:'#d1fae5' });
      </script>";
    }
  }

  // Simpan ke database
  $stmt = $conn->prepare("INSERT INTO struktur_pemerintahan (nama, jabatan, urutan, foto) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssis", $nama, $jabatan, $urutan, $foto);

  if ($stmt->execute()) {
    echo "<script>
      Swal.fire({ 
        icon: 'success', 
        title: 'Berhasil!', 
        text: 'Data berhasil ditambahkan.', 
        background:'#062015',
        color:'#d1fae5',
        showConfirmButton: false,
        timer: 1500 
      }).then(() => window.location='struktur.php');
    </script>";
  } else {
    echo "<script>
      Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Tidak dapat menyimpan data.', background:'#062015', color:'#d1fae5' });
    </script>";
  }
  $stmt->close();
}

include 'footer.php';
?>
