<?php
include_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semua Berita - Kelurahan Talikuran Utara</title>

  <!-- Tailwind & Fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <link rel="icon" type="image/png" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">

  <style>
    body { font-family: 'Poppins', sans-serif; }
    .nav-link {
      position: relative;
      transition: color .3s ease;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      left: 0; bottom: -4px;
      width: 0; height: 2px;
      background: #22c55e;
      transition: width .3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .nav-link:hover {
      color: #166534;
    }
  </style>
</head>

<body class="font-poppins bg-gray-50 text-gray-900 overflow-x-hidden">

  <!-- 🔹 HEADER (sama seperti index.php) -->
  <header id="navbar" class="fixed top-0 left-0 w-full z-50 bg-transparent transition-all duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
      <!-- Logo -->
      <div class="flex items-center gap-2">
        <img src="assets/logo.png" alt="Logo" class="w-10 h-10 drop-shadow-md hover:scale-110 transition">
        <h1 class="font-merriweather text-xl md:text-2xl font-bold text-green-800 tracking-wide">Talikuran Utara</h1>
      </div>

      <!-- Navigasi Desktop -->
      <nav class="hidden md:flex gap-6 text-sm font-medium text-gray-800">
        <a href="index.php#home" class="nav-link">Beranda</a>
        <a href="index.php#profil" class="nav-link">Profil Kelurahan</a>
        <a href="index.php#potensi" class="nav-link">Potensi Kelurahan</a>
        <a href="berita_all.php" class="nav-link text-green-800 font-semibold">Berita</a>
        <a href="index.php#galeri" class="nav-link">Galeri</a>
        <a href="index.php#peta" class="nav-link">Peta</a>
        <a href="index.php#lapor" class="nav-link flex items-center gap-1">Lapor</a>
      </nav>

      <!-- Tombol Mobile -->
      <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden bg-white/95 backdrop-blur-lg shadow-md md:hidden flex-col space-y-3 px-6 py-4 text-gray-800 font-medium">
      <a href="index.php#home" class="block hover:text-green-700 transition">Beranda</a>
      <a href="index.php#profil" class="block hover:text-green-700 transition">Profil Kelurahan</a>
      <a href="index.php#potensi" class="block hover:text-green-700 transition">Potensi Kelurahan</a>
      <a href="berita_all.php" class="block font-semibold text-green-800">Berita</a>
      <a href="index.php#galeri" class="block hover:text-green-700 transition">Galeri</a>
      <a href="index.php#peta" class="block hover:text-green-700 transition">Peta</a>
      <a href="index.php#lapor" class="block flex items-center gap-1 hover:text-green-700 transition">
        <i class="bi bi-megaphone-fill text-green-700"></i> Lapor
      </a>
    </div>
  </header>

  <!-- Script Header -->
  <script>
    const navbar = document.getElementById("navbar");
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    // Efek scroll transparan
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        navbar.classList.add("bg-white/90", "backdrop-blur-lg", "shadow-md");
      } else {
        navbar.classList.remove("bg-white/90", "backdrop-blur-lg", "shadow-md");
      }
    });

    // Toggle mobile menu
    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
      menuBtn.classList.toggle("text-green-600");
    });
  </script>

  <!-- 🔸 SEMUA BERITA -->
  <section class="pt-32 pb-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex justify-center items-center gap-3 mb-10" data-aos="fade-down">
        <i class="bi bi-newspaper text-green-700 text-3xl"></i>
        <h2 class="text-3xl font-merriweather font-bold text-green-900">Semua Berita Kelurahan Talikuran Utara</h2>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <?php
        $query = $conn->query("SELECT * FROM berita ORDER BY tanggal DESC");
        while ($row = $query->fetch_assoc()) {
          $gambarPath = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto']))
            ? "../" . $row['foto']
            : "https://via.placeholder.com/400x250?text=No+Image";

          echo "
          <div class='group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col justify-between transform hover:scale-[1.02]' data-aos='zoom-in'>
            <img src='$gambarPath' alt='Gambar Berita' class='w-full h-48 object-cover group-hover:brightness-105 group-hover:scale-[1.03] transition-transform duration-700'>

            <div class='flex flex-col justify-between flex-grow p-6 text-left'>
              <h3 class='font-semibold text-lg mb-2 text-green-900 group-hover:text-green-800 transition-colors'>
                ".htmlspecialchars($row['judul'])."
              </h3>
              
              <div class='flex items-center gap-2 text-gray-600 text-sm mb-3'>
                <i class='bi bi-calendar-week text-green-700 text-base'></i>
                <span class='align-middle'>".date('d M Y', strtotime($row['tanggal']))."</span>
              </div>

              <p class='text-sm text-gray-700 text-justify leading-relaxed mb-4'>
                ".substr(strip_tags($row['isi']), 0, 130)."... 
              </p>

              <a href='berita_detail.php?id={$row['id']}' class='inline-flex items-center gap-2 text-green-700 font-semibold text-sm border border-green-700 rounded-lg px-4 py-2 hover:bg-green-700 hover:text-white transition-all duration-500 group-hover:translate-y-[-2px]'>
                Baca Selengkapnya <i class='bi bi-arrow-right-short text-lg'></i>
              </a>
            </div>
          </div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script>
    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>