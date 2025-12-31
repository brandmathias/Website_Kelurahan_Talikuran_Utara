<?php
include_once __DIR__ . '/../config/config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$berita = $conn->query("SELECT * FROM berita WHERE id = $id")->fetch_assoc();

if (!$berita) {
  die("<h2 class='text-center mt-40 text-red-600 font-bold'>Berita tidak ditemukan.</h2>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($berita['judul']); ?> - Kelurahan Talikuran Utara</title>

  <!-- ✅ Resource -->
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
    .nav-link:hover::after { width: 100%; }
    .nav-link:hover { color: #166534; }
  </style>
</head>

<body class="font-poppins bg-gray-50 text-gray-900 overflow-x-hidden">

  <!-- 🔹 HEADER (Sama persis dengan index.php) -->
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

  <!-- 🔸 KONTEN BERITA DETAIL -->
  <section class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
      <!-- Tombol kembali -->
      <a href="berita_all.php" 
         class="inline-flex items-center gap-2 text-green-700 hover:text-white hover:bg-green-700 border border-green-700 rounded-full px-4 py-2 text-sm mb-8 transition-all duration-500 shadow-sm">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
      </a>

      <!-- Judul -->
      <h1 class="text-4xl font-merriweather font-bold mb-3 text-green-900 leading-tight" data-aos="fade-up">
        <?php echo htmlspecialchars($berita['judul']); ?>
      </h1>

      <!-- Tanggal -->
      <div class="flex items-center gap-2 mb-8 text-gray-600 text-sm" data-aos="fade-up" data-aos-delay="100">
        <i class="bi bi-calendar-week text-green-700 text-base"></i>
        <span><?php echo date('d F Y', strtotime($berita['tanggal'])); ?></span>
      </div>

      <!-- Gambar -->
      <?php if (!empty($berita['foto'])): ?>
        <img src="../<?php echo $berita['foto']; ?>" 
             class="w-full rounded-2xl shadow-lg mb-10 transition-transform duration-700 hover:scale-[1.02]" 
             data-aos="zoom-in" alt="Gambar Berita">
      <?php endif; ?>

      <!-- Isi berita -->
      <div class="bg-white p-8 rounded-2xl shadow text-justify leading-relaxed text-gray-700 prose max-w-none" data-aos="fade-up" data-aos-delay="200">
        <?php echo nl2br($berita['isi']); ?>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <?php include 'footer.php'; ?>

  <script>
    // AOS animation init
    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>