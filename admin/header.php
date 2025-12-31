<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin'])) {
  header('Location: login.php'); exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Talikuran Utara</title>

  <link rel="icon" type="image/png" href="logo.png" sizes="32x32" />
  <meta name="theme-color" content="#0b1f16" />

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #0b1f16;
      color: #eaffea;
      transition: background 0.5s ease, color 0.5s ease;
    }

    header {
      background: rgba(11, 31, 22, 0.85);
      backdrop-filter: blur(16px);
      box-shadow: 0 0 25px rgba(0, 255, 150, 0.1);
      border-bottom: 1px solid rgba(255,255,255,0.08);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 50;
      transition: all 0.4s ease;
    }

    header.scrolled {
      background: rgba(11, 31, 22, 0.95);
      box-shadow: 0 0 40px rgba(0, 255, 150, 0.2);
    }

    .nav-link {
      color: #c7f9cc;
      transition: all 0.3s ease;
      position: relative;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      left: 0;
      bottom: -4px;
      background: #22c55e;
      transition: 0.3s;
      border-radius: 2px;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link:hover {
      color: #86efac;
      text-shadow: 0 0 6px rgba(34,197,94,0.6);
    }

    /* Efek fade-out saat logout */
    .fade-out {
      animation: fadeOut 0.8s forwards;
    }

    @keyframes fadeOut {
      from { opacity: 1; transform: scale(1); }
      to { opacity: 0; transform: scale(0.97); }
    }
  </style>
</head>

<body class="min-h-screen relative">

<header id="adminHeader" class="transition-all">
  <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="logo.png" class="w-10 h-10 animate-pulse drop-shadow-[0_0_10px_rgba(0,255,150,0.4)]">
      <h1 class="text-xl md:text-2xl font-semibold text-emerald-300 drop-shadow-[0_0_10px_rgba(0,255,150,0.4)]">
        Admin Talikuran Utara
      </h1>
    </div>
    <nav class="flex flex-wrap gap-6 text-sm md:text-base items-center">
      <a href="dashboard.php" class="nav-link">Dashboard</a>
      <a href="profil.php" class="nav-link">Profil</a>
      <a href="struktur.php" class="nav-link">Struktur</a>
      <a href="potensi.php" class="nav-link">Potensi</a>
      <a href="berita.php" class="nav-link">Berita</a>
      <a href="galeri.php" class="nav-link">Galeri</a>
      <a href="laporan.php" class="nav-link">Laporan</a>
      <a href="#" id="logoutBtn" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium transition-all hover:shadow-[0_0_12px_rgba(34,197,94,0.6)] active:scale-[0.97] flex items-center gap-2">
        <i class="bi bi-box-arrow-right text-lg"></i> Logout
      </a>
    </nav>
  </div>
</header>

<main class="max-w-7xl mx-auto px-6 pt-28 pb-12">

<script>
AOS.init({ duration: 1000, once: true });

// Efek glow saat scroll
window.addEventListener('scroll', () => {
  const header = document.getElementById('adminHeader');
  header.classList.toggle('scrolled', window.scrollY > 20);
});

// Tombol Logout Interaktif
document.getElementById("logoutBtn").addEventListener("click", async (e) => {
  e.preventDefault();
  const result = await Swal.fire({
    title: "Yakin ingin keluar?",
    text: "Sesi Anda akan diakhiri.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#10b981",
    cancelButtonColor: "#6b7280",
    confirmButtonText: "Ya, Logout",
    cancelButtonText: "Batal",
    background: "rgba(15,36,28,0.9)",
    color: "#d1fae5",
    showClass: { popup: "animate__animated animate__fadeInDown" },
    hideClass: { popup: "animate__animated animate__fadeOutUp" },
  });

  if (result.isConfirmed) {
    document.body.classList.add("fade-out");
    setTimeout(() => {
      window.location.href = "logout.php";
    }, 900);
  }
});
</script>