<?php
include_once(__DIR__ . '/../config/config.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita Kelurahan Talikuran Utara</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="assets/logo.png">
  <link rel="apple-touch-icon" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body class="bg-gray-50 text-gray-800 font-[Poppins]">
  <?php include('navbar.php'); ?>

  <section class="py-16 max-w-7xl mx-auto px-6">
    <div class="flex justify-center items-center gap-3 mb-10" data-aos="fade-down">
      <i class="bi bi-newspaper text-green-700 text-3xl"></i>
      <h1 class="text-3xl font-bold text-green-900 font-merriweather">Daftar Berita Kelurahan Talikuran Utara</h1>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
      $result = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
      while ($row = mysqli_fetch_assoc($result)) {
        $gambarPath = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto']))
          ? "../" . $row['foto']
          : "https://via.placeholder.com/400x250?text=No+Image";

        echo "
        <div class='group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col justify-between transform hover:scale-[1.02]' data-aos='zoom-in'>
          <img src='$gambarPath' alt='Gambar Berita' class='w-full h-48 object-cover group-hover:brightness-105 group-hover:scale-[1.03] transition-transform duration-700'>

          <div class='flex flex-col justify-between flex-grow p-5 text-left'>
            <div>
              <h3 class='text-lg font-semibold mb-2 text-green-900 group-hover:text-green-800 transition-colors leading-tight'>
                " . htmlspecialchars($row['judul']) . "
              </h3>

              <!-- 📅 Tanggal berita rata kiri -->
              <div class='flex items-center gap-2 mb-3 text-gray-600 text-sm'>
                <i class='bi bi-calendar-week text-green-700 text-base'></i>
                <span class='align-middle'>" . date('d M Y', strtotime($row['tanggal'])) . "</span>
              </div>

              <p class='text-sm text-gray-700 text-justify leading-relaxed mb-4'>
                " . substr(strip_tags($row['isi']), 0, 120) . "...
              </p>
            </div>

            <!-- Tombol -->
            <div class='mt-auto'>
              <a href='berita_detail.php?id={$row['id']}'
                 class='inline-flex items-center gap-2 text-green-700 font-semibold text-sm
                        border border-green-700 rounded-lg px-4 py-2 hover:bg-green-700 hover:text-white
                        transition-all duration-500 group-hover:translate-y-[-2px]'>
                Baca Selengkapnya
                <i class='bi bi-arrow-right-short text-lg'></i>
              </a>
            </div>
          </div>
        </div>";
      }
      ?>
    </div>
  </section>

  <?php include('footer.php'); ?>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>

  <style>
    body { background-color: #f9fafb; }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
  </style>
</body>
</html>