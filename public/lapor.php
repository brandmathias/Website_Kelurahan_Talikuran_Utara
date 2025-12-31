<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lapor Warga - Kelurahan Talikuran Utara</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-gray-50 text-gray-800 font-[Poppins]">

  <?php include('navbar.php'); ?>

  <section class="p-8 max-w-3xl mx-auto" data-aos="fade-up">
    <div class="text-center mb-6">
      <i class="bi bi-exclamation-octagon text-green-700 text-5xl mb-2"></i>
      <h1 class="text-3xl font-bold mb-2 text-green-800">Fitur Lapor Warga</h1>
      <p class="text-gray-600">Laporkan masalah di lingkungan Anda untuk ditindaklanjuti oleh admin kelurahan.</p>
    </div>

    <form method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-6 space-y-4">
      <input type="text" name="nama_pelapor" placeholder="Nama Pelapor" required class="border border-gray-300 rounded w-full p-3 focus:ring-2 focus:ring-green-600">
      <input type="text" name="kontak" placeholder="Email atau Nomor Telepon" required class="border border-gray-300 rounded w-full p-3 focus:ring-2 focus:ring-green-600">
      <input type="text" name="judul_laporan" placeholder="Judul Laporan (misal: Lampu Jalan Mati di RT 02)" required class="border border-gray-300 rounded w-full p-3 focus:ring-2 focus:ring-green-600">
      <textarea name="isi_laporan" rows="5" placeholder="Deskripsikan masalah Anda secara detail..." required class="border border-gray-300 rounded w-full p-3 focus:ring-2 focus:ring-green-600"></textarea>
      
      <select name="kategori" class="border border-gray-300 rounded w-full p-3 focus:ring-2 focus:ring-green-600">
        <option value="">Pilih Kategori (Opsional)</option>
        <option value="Infrastruktur">Infrastruktur</option>
        <option value="Lingkungan">Lingkungan</option>
        <option value="Keamanan">Keamanan</option>
        <option value="Sosial">Sosial</option>
      </select>

      <div>
        <label class="block text-gray-700 mb-2">Unggah Foto (Opsional)</label>
        <input type="file" name="foto" accept="image/*" class="border border-gray-300 rounded w-full p-2 focus:ring-2 focus:ring-green-600">
      </div>

      <button type="submit" name="kirim" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition flex items-center justify-center gap-2">
        <i class="bi bi-send"></i> Kirim Laporan
      </button>
    </form>

    <?php
    if (isset($_POST['kirim'])) {
        include('../config/config.php');
        $nama = $_POST['nama_pelapor'];
        $kontak = $_POST['kontak'];
        $judul = $_POST['judul_laporan'];
        $isi = $_POST['isi_laporan'];
        $kategori = $_POST['kategori'] ?? null;

        // Upload foto jika ada
        $fotoPath = null;
        if (!empty($_FILES['foto']['name'])) {
            $targetDir = "../uploads/";
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
            $fotoPath = $targetDir . basename($_FILES["foto"]["name"]);
            move_uploaded_file($_FILES["foto"]["tmp_name"], $fotoPath);
        }

        $stmt = $conn->prepare("INSERT INTO laporan (nama_pelapor, kontak, judul_laporan, isi_laporan, kategori, foto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nama, $kontak, $judul, $isi, $kategori, $fotoPath);
        $stmt->execute();

        echo "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Laporan Berhasil Dikirim!',
          text: 'Terima kasih, laporan Anda telah kami terima untuk ditinjau oleh admin kelurahan.',
          showConfirmButton: false,
          timer: 2500
        });
        </script>";
    }
    ?>
  </section>

  <?php include('footer.php'); ?>

  <script>AOS.init({duration: 1000, once: true});</script>
</body>
</html>
