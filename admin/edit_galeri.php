<?php
include 'header.php';
include_once('../config/config.php');

// Ambil ID galeri dari URL
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
  echo "<script>alert('Data galeri tidak ditemukan!');window.location='galeri.php';</script>";
  exit;
}

// Ambil data dari database
$q = $conn->query("SELECT * FROM galeri WHERE id=$id");
if (!$q || $q->num_rows == 0) {
  echo "<script>alert('Data galeri tidak ditemukan!');window.location='galeri.php';</script>";
  exit;
}
$data = $q->fetch_assoc();

// Proses update galeri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = trim($_POST['judul'] ?? '');
  $fotoBaru = $_FILES['foto']['name'] ?? '';
  $fotoLama = $data['foto'];
  $uploadPath = '../uploads/';

  if ($fotoBaru) {
    $ext = strtolower(pathinfo($fotoBaru, PATHINFO_EXTENSION));
    $newFile = $uploadPath . time() . '_' . uniqid() . '.' . $ext;
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $newFile)) {
      if (!empty($fotoLama) && file_exists('../' . $fotoLama)) unlink('../' . $fotoLama);
      $fotoLama = str_replace('../', '', $newFile);
    }
  }

  $stmt = $conn->prepare("UPDATE galeri SET judul=?, foto=? WHERE id=?");
  $stmt->bind_param("ssi", $judul, $fotoLama, $id);
  $ok = $stmt->execute();

  if ($ok) {
    echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Galeri berhasil diperbarui.',
        showConfirmButton: false,
        timer: 1300,
        background: 'rgba(15,36,28,0.9)',
        color: '#d1fae5'
      }).then(()=>{ window.location='galeri.php'; });
    </script>";
  } else {
    echo "<script>Swal.fire('Gagal!','Terjadi kesalahan saat menyimpan data.','error');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Galeri</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#03140d] min-h-screen font-[Poppins] text-emerald-50 py-10 px-6">

  <div class="max-w-4xl mx-auto p-10 bg-[#092016]/90 rounded-2xl border border-emerald-700/50 shadow-[0_0_45px_rgba(0,255,150,0.15)] backdrop-blur-xl" data-aos="zoom-in">
    <h2 class="text-3xl font-bold text-emerald-300 mb-8 flex items-center gap-3 drop-shadow-[0_0_12px_rgba(0,255,150,0.4)]">
      <i class="bi bi-image text-emerald-400 animate-pulse"></i> Edit Galeri
    </h2>

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
      <!-- Judul -->
      <div>
        <label class="block text-sm font-semibold text-emerald-200 mb-1">Judul Galeri</label>
        <input type="text" name="judul" required
          value="<?= htmlspecialchars($data['judul']); ?>"
          class="w-full p-3 rounded-lg bg-emerald-950/40 border border-emerald-700/50 text-emerald-50 focus:ring-2 focus:ring-emerald-500 outline-none transition">
      </div>

      <!-- Foto -->
      <div>
        <label class="block text-sm font-semibold text-emerald-200 mb-2">Foto Galeri</label>

        <!-- Preview Gambar Utama -->
        <img id="preview-image"
             src="../<?= htmlspecialchars($data['foto']); ?>"
             class="w-full rounded-xl border border-emerald-700/50 shadow-[0_0_25px_rgba(16,185,129,0.3)] mb-4">

        <!-- Input File -->
        <label class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-emerald-700/50 rounded-lg bg-emerald-950/30 hover:bg-emerald-900/30 cursor-pointer transition-all">
          <i class="bi bi-cloud-arrow-up text-2xl text-emerald-400"></i>
          <p class="text-sm text-emerald-300 mt-2">Klik untuk memilih gambar baru</p>
          <input type="file" name="foto" id="file-input" accept="image/*" class="hidden">
        </label>

        <!-- Preview Panel -->
        <div id="preview-container" class="mt-4 hidden">
          <p class="text-emerald-200 text-sm mb-1 font-medium">Pratinjau Gambar Baru:</p>
          <img id="preview-new" class="w-full rounded-xl border border-emerald-700/40 shadow-[0_0_20px_rgba(16,185,129,0.3)]">
        </div>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-4 pt-6">
        <a href="galeri.php"
           class="bg-gray-700/60 hover:bg-gray-600 text-gray-100 px-5 py-2.5 rounded-lg flex items-center gap-2 transition">
          <i class="bi bi-arrow-left-circle"></i> Batal
        </a>
        <button type="submit"
                class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(0,255,150,0.3)] hover:shadow-[0_0_25px_rgba(0,255,150,0.5)] transition-all flex items-center gap-2">
          <i class="bi bi-check-circle"></i> Perbarui
        </button>
      </div>
    </form>
  </div>

  <script>
  // Inisialisasi AOS
  AOS.init({ duration: 900, once: true });

  // Preview Gambar Baru
  const fileInput = document.getElementById('file-input');
  const previewContainer = document.getElementById('preview-container');
  const previewNew = document.getElementById('preview-new');

  fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        previewContainer.classList.remove('hidden');
        previewNew.src = e.target.result;
      };
      reader.readAsDataURL(file);
    } else {
      previewContainer.classList.add('hidden');
    }
  });
  </script>
</body>
</html>

<?php include 'footer.php'; ?>
