<?php
// Pastikan koneksi config sudah tersedia
include_once __DIR__ . '/../config/config.php';
?>

<!-- 🔹 HEADER UTAMA WEBSITE TALIKURAN UTARA -->
<header id="navbar" class="fixed top-0 left-0 w-full z-50 bg-transparent transition-all duration-300 ease-in-out">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
    
    <!-- 🟩 Logo -->
    <div class="flex items-center gap-2">
        <link rel="icon" href="https://talikuranutara.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="https://talikuranutara.com/favicon.ico" type="image/x-icon">
      <img src="assets/logo.png" alt="Logo" class="w-10 h-10 drop-shadow-md hover:scale-110 transition">
      <h1 class="font-merriweather text-xl md:text-2xl font-bold text-primary tracking-wide">
        Talikuran Utara
      </h1>
    </div>

    <!-- 🟢 Navigasi Desktop -->
    <nav class="hidden md:flex gap-6 text-sm font-medium text-gray-800">
      <a href="#home" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Beranda</a>
      <a href="#profil" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Profil Kelurahan</a>
      <a href="#potensi" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Potensi Kelurahan</a>
      <a href="#berita" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Berita</a>
      <a href="#galeri" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Galeri</a>
      <a href="#peta" class="nav-link relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Peta</a>
      <!-- ✅ Ubah dari Kontak → Lapor -->
      <a href="#lapor" class="nav-link flex items-center gap-1 relative after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary after:transition-all hover:after:w-full hover:text-primary">Lapor</a>
    </nav>

    <!-- 🔘 Tombol Menu Mobile -->
    <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <!-- 🟣 Menu Mobile -->
  <div id="mobile-menu" class="hidden bg-white/95 backdrop-blur-lg shadow-md md:hidden flex-col space-y-3 px-6 py-4 text-gray-800 font-medium">
    <a href="#home" class="block hover:text-primary transition">Beranda</a>
    <a href="#profil" class="block hover:text-primary transition">Profil Kelurahan</a>
    <a href="#potensi" class="block hover:text-primary transition">Potensi Kelurahan</a>
    <a href="#berita" class="block hover:text-primary transition">Berita</a>
    <a href="#galeri" class="block hover:text-primary transition">Galeri</a>
    <a href="#peta" class="block hover:text-primary transition">Peta</a>
    <!-- ✅ Menu baru -->
    <a href="#lapor" class="block flex items-center gap-1 hover:text-primary transition">
      <i class="bi bi-megaphone-fill text-green-700"></i> Lapor
    </a>
  </div>
</header>

<!-- 🎬 SCRIPT INTERAKTIF NAVBAR -->
<script>
  const navbar = document.getElementById("navbar");
  const links = document.querySelectorAll(".nav-link");
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  // 🧭 Scroll effect
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("bg-white/90", "backdrop-blur-lg", "shadow-md");
    } else {
      navbar.classList.remove("bg-white/90", "backdrop-blur-lg", "shadow-md");
    }
  });

  // 🪶 Smooth scroll ke section
  links.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      const target = document.querySelector(link.getAttribute("href"));
      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
        mobileMenu.classList.add("hidden");
      }
    });
  });

  // 📱 Toggle menu mobile
  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    menuBtn.classList.toggle("text-primary");
  });
</script>
