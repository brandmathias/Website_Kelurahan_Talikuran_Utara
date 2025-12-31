<?php include('../config/config.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Desa Talikuran Utara</title>

  <!-- Tailwind & AOS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/logo.png" sizes="32x32">
  <link rel="apple-touch-icon" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800 font-[Poppins]">
  <?php include('navbar.php'); ?>

  <!-- 🔹 Section Profil Desa -->
  <section class="py-16 px-6 max-w-6xl mx-auto">
    <div class="flex items-center justify-center gap-3 mb-8" data-aos="fade-down">
      <i class="bi bi-info-circle text-green-700 text-3xl"></i>
      <h1 class="text-3xl font-bold text-green-800 font-merriweather">Profil Desa</h1>
    </div>

    <?php
    $profil = $conn->query("SELECT * FROM profil_desa ORDER BY id ASC");
    if ($profil && $profil->num_rows > 0) {
      echo '<div class="grid md:grid-cols-2 gap-10">';
      $delay = 0;

      while ($row = $profil->fetch_assoc()) {
        $delay += 100;
        $judul = htmlspecialchars($row['judul']);
        $isi = nl2br(htmlspecialchars($row['isi']));

        echo "
        <div class='bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 transition-all duration-500 transform hover:-translate-y-1' 
             data-aos='fade-up' data-aos-delay='$delay'>
          <div class='flex items-center gap-2 mb-3'>
            <i class='bi bi-book text-green-700 text-2xl'></i>
            <h2 class='text-2xl font-semibold text-green-800'>$judul</h2>
          </div>
          <p class='text-gray-700 text-justify leading-relaxed'>$isi</p>
        </div>";
      }

      echo '</div>';
    } else {
      echo "
      <div class='text-center text-gray-500 mt-10' data-aos='fade-up'>
        <i class='bi bi-exclamation-circle text-4xl text-gray-400 mb-3'></i>
        <p>Belum ada data profil desa yang tersedia.</p>
      </div>";
    }
    ?>
  </section>

  <?php include('footer.php'); ?>
  <script>AOS.init({ duration: 1000, once: true });</script>
</body>
</html>
