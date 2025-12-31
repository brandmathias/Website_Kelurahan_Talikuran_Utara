<?php
include('header.php');
include_once('../config/config.php');

// Fungsi aman untuk menghitung jumlah baris
function safeCount($conn, $table) {
  $res = $conn->query("SELECT COUNT(*) AS c FROM $table");
  if ($res && $row = $res->fetch_assoc()) return $row['c'];
  return 0;
}

$berita  = safeCount($conn, 'berita');
$galeri  = safeCount($conn, 'galeri');
$laporan = safeCount($conn, 'laporan');
$potensi = safeCount($conn, 'potensi');
$profil  = safeCount($conn, 'profil_desa');
?>

<div class="relative z-10 max-w-6xl mx-auto px-6 py-12">
  <!-- Header -->
  <div class="flex flex-col md:flex-row items-center justify-between mb-10">
    <div>
      <h2 class="text-3xl md:text-4xl font-extrabold text-emerald-300 mb-2 flex items-center gap-2 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)]">
        <i class="bi bi-speedometer2 text-emerald-400"></i> Dashboard Admin
      </h2>
      <p class="text-emerald-100 text-sm">Sistem Informasi Aurora — Kelurahan Talikuran Utara</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center gap-3">
      <i class="bi bi-shield-lock-fill text-green-400 text-2xl animate-pulse"></i>
      <span class="text-emerald-100 text-sm">Akses Aman Diverifikasi</span>
    </div>
  </div>

  <!-- Cards -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <div onclick="location.href='berita.php'" class="dashboard-card p-8 text-center hover:border-emerald-500" data-aos="zoom-in">
      <i class="bi bi-newspaper text-4xl text-green-400"></i>
      <h3 class="mt-3 font-semibold text-green-200">Total Berita</h3>
      <p class="text-4xl font-bold text-green-100 mt-1 count-up" data-target="<?= $berita ?>">0</p>
    </div>

    <div onclick="location.href='galeri.php'" class="dashboard-card p-8 text-center hover:border-yellow-500" data-aos="zoom-in" data-aos-delay="100">
      <i class="bi bi-images text-4xl text-yellow-400"></i>
      <h3 class="mt-3 font-semibold text-yellow-200">Total Galeri</h3>
      <p class="text-4xl font-bold text-yellow-100 mt-1 count-up" data-target="<?= $galeri ?>">0</p>
    </div>

    <div onclick="location.href='laporan.php'" class="dashboard-card p-8 text-center hover:border-blue-400" data-aos="zoom-in" data-aos-delay="200">
      <i class="bi bi-megaphone-fill text-4xl text-blue-400"></i>
      <h3 class="mt-3 font-semibold text-blue-200">Total Laporan</h3>
      <p class="text-4xl font-bold text-blue-100 mt-1 count-up" data-target="<?= $laporan ?>">0</p>
    </div>

    <div onclick="location.href='potensi.php'" class="dashboard-card p-8 text-center hover:border-orange-400" data-aos="zoom-in" data-aos-delay="300">
      <i class="bi bi-bar-chart-fill text-4xl text-orange-400"></i>
      <h3 class="mt-3 font-semibold text-orange-200">Total Potensi Kelurahan</h3>
      <p class="text-4xl font-bold text-orange-100 mt-1 count-up" data-target="<?= $potensi ?>">0</p>
    </div>

    <div onclick="location.href='profil.php'" class="dashboard-card p-8 text-center hover:border-purple-400" data-aos="zoom-in" data-aos-delay="400">
      <i class="bi bi-person-badge text-4xl text-purple-400"></i>
      <h3 class="mt-3 font-semibold text-purple-200">Jumlah Profil</h3>
      <p class="text-4xl font-bold text-purple-100 mt-1 count-up" data-target="<?= $profil ?>">0</p>
    </div>
  </div>

  <div class="text-center text-emerald-200 text-xs mt-12 opacity-70">
    © 2025 Kelurahan Talikuran Utara — Aurora Secure Environment
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
AOS.init({ duration: 1200, once: true });

// Count-up animasi lembut
window.addEventListener('DOMContentLoaded', () => {
  const counters = document.querySelectorAll('.count-up');
  counters.forEach(counter => {
    const update = () => {
      const target = +counter.getAttribute('data-target');
      const current = +counter.innerText.replace(/\D/g,'') || 0;
      const increment = target / 60; // jumlah frame (semakin besar semakin lambat)

      if (current < target) {
        counter.innerText = Math.ceil(current + increment);
        requestAnimationFrame(update);
      } else {
        counter.innerText = target.toLocaleString();
      }
    };
    update();
  });
});
</script>

<style>
.dashboard-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 1rem;
  box-shadow: 0 0 25px rgba(0, 255, 150, 0.1);
  transition: all 0.4s ease;
  backdrop-filter: blur(12px);
  cursor: pointer;
}
.dashboard-card:hover {
  transform: scale(1.05);
  box-shadow: 0 0 40px rgba(0, 255, 150, 0.35);
}
</style>

<?php include('footer.php'); ?>
