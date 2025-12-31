<?php include 'header.php'; ?>

<h2 class="text-3xl font-bold mb-6 text-[hsl(130,30%,30%)] flex items-center gap-2">
  <i class="bi bi-images text-green-700 text-3xl"></i>
  Kelola Galeri Kelurahan
</h2>

<a href="tambah_galeri.php" 
   class="bg-[hsl(130,30%,30%)] text-white px-4 py-2 rounded-lg hover:bg-[hsl(130,25%,25%)] inline-flex items-center gap-2 mb-6 transition-all duration-500 hover:scale-[1.03]">
  <i class="bi bi-plus-circle"></i> Tambah Gambar
</a>

<!-- 🌿 Container Carousel -->
<div class="relative overflow-hidden py-10 bg-gradient-to-b from-green-50 via-white to-green-50 rounded-3xl">
  <div class="carousel-track flex gap-6 items-center px-6">
    <?php
    include_once('../config/config.php');
    $result = $conn->query("SELECT * FROM galeri ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
    ?>
      <div class="carousel-item flex-shrink-0 w-72 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-700 overflow-hidden group relative">
        <div class="overflow-hidden relative">
          <img src="../<?php echo $row['gambar']; ?>" 
               alt="Gambar Galeri" 
               class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
          <!-- Overlay Animasi -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700 flex items-end justify-center">
            <p class="text-white text-sm mb-3 font-medium tracking-wide">Klik untuk detail</p>
          </div>
        </div>

        <div class="p-4 text-center relative z-10">
          <h3 class="font-semibold text-lg text-green-800 mb-2 flex items-center justify-center gap-1">
            <i class="bi bi-image"></i> <?php echo $row['judul']; ?>
          </h3>
          <p class="text-sm text-gray-500 mb-3 flex items-center justify-center gap-1">
            <i class="bi bi-calendar3"></i> <?php echo $row['tanggal']; ?>
          </p>
          <a href="hapus_galeri.php?id=<?php echo $row['id']; ?>" 
             onclick="return confirm('Yakin hapus gambar ini?')"
             class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 transition font-medium">
            <i class="bi bi-trash3-fill"></i> Hapus
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- 🎨 Style Animasi -->
<style>
  .carousel-track {
    width: max-content;
    animation: scrollLeft 45s linear infinite;
  }

  @keyframes scrollLeft {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }

  .carousel-item {
    min-width: 280px;
    transition: transform 0.6s ease, box-shadow 0.6s ease;
  }

  .carousel-item:hover {
    transform: translateY(-5px) scale(1.03);
  }

  /* Responsif */
  @media (max-width: 768px) {
    .carousel-track {
      animation-duration: 60s;
    }
  }
</style>

<!-- ⚙️ GSAP Infinite Animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
  gsap.utils.toArray(".carousel-item").forEach((card, i) => {
    // Efek melayang random halus
    gsap.to(card, {
      y: "random(-15, 15)",
      rotateZ: "random(-1.5, 1.5)",
      duration: "random(3, 6)",
      ease: "sine.inOut",
      yoyo: true,
      repeat: -1,
      delay: i * 0.3
    });
  });

  // Efek fade-in tiap card saat pertama kali muncul
  gsap.from(".carousel-item", {
    opacity: 0,
    y: 50,
    stagger: 0.15,
    duration: 1.2,
    ease: "power2.out"
  });
</script>

<?php include 'footer.php'; ?>
