<?php include('../config/config.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Potensi Kelurahan — Kelurahan Talikuran Utara</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <link rel="icon" type="image/png" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">

  <style>
    :root {
      --green: #0d5f3f;
      --cream: #fafaf7;
    }

    body {
      font-family: 'Outfit', sans-serif;
      color: #1a1a1a;
      overflow-x: hidden;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      transition: background-image 1.5s ease-in-out;
    }

    .nav-link {
      position: relative;
      transition: color .3s ease;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -4px;
      width: 0;
      height: 2px;
      background-color: #22c55e;
      transition: width .3s ease;
      border-radius: 2px;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .nav-link:hover {
      color: #166534;
    }

    /* 🌿 Hero Section */
    .hero {
      min-height: 60vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 8rem 2rem 4rem 2rem;
      background: rgba(255,255,255,0.5);
      position: relative;
      z-index: 5;
    }

    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 6vw, 4rem);
      color: var(--green);
      font-weight: 700;
      line-height: 1.3;
    }

    .hero span {
      background: linear-gradient(90deg, #008f56, #00d084);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero p {
      max-width: 700px;
      margin-top: 1rem;
      color: #333;
      font-size: 1.1rem;
    }

    /* 🌾 Potensi Section */
    .section {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 6rem 1rem;
      position: relative;
      z-index: 5;
      background: rgba(255,255,255,0.85);
      border-radius: 1rem;
      margin: 4rem auto;
      max-width: 1200px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .section-content {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      width: 100%;
    }

    @media (min-width: 768px) {
      .section-content {
        flex-direction: row;
        align-items: center;
      }
    }

    .image-wrapper {
      flex: 1;
      overflow: hidden;
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      display: flex;
      justify-content: center;
      align-items: stretch;
      aspect-ratio: 16 / 9;
    }

    .image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 1.5s ease;
    }

    .image-wrapper:hover img {
      transform: scale(1.07);
    }

    .section-text {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .section-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 3vw, 2.5rem);
      color: var(--green);
      margin-bottom: 1rem;
    }

    .section-text p {
      font-size: 1rem;
      line-height: 1.8;
      color: #333;
      text-align: justify;
    }

  </style>
</head>

<body>
<!-- ✅ Header disamakan dengan index.php -->
<header id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
    <div class="flex items-center gap-2">
      <img src="assets/logo.png" alt="Logo" class="w-10 h-10">
      <h1 class="font-merriweather text-xl font-bold text-green-900">Talikuran Utara</h1>
    </div>
    <nav class="hidden md:flex gap-6 text-sm font-medium">
      <a href="index.php#home" class="nav-link">Beranda</a>
      <a href="index.php#profil" class="nav-link">Profil Kelurahan</a>
      <a href="index.php#potensi" class="nav-link">Potensi Kelurahan</a>
      <a href="berita_all.php" class="nav-link">Berita</a>
      <a href="galeri_all.php" class="nav-link text-green-800 font-semibold">Galeri</a>
      <a href="index.php#peta" class="nav-link">Peta</a>
      <a href="index.php#lapor" class="nav-link">Lapor</a>
    </nav>
  </div>
</header>

  <!-- Hero -->
  <section class="hero">
    <h1 class="opacity-0 translate-y-8">Eksplorasi <span>Potensi</span> Kelurahan Talikuran Utara</h1>
    <p class="opacity-0 translate-y-8">Temukan kekayaan alam, budaya, dan semangat masyarakat yang membentuk jati diri Talikuran Utara.</p>
  </section>

  <!-- Potensi -->
  <?php
  $q = $conn->query("SELECT * FROM potensi ORDER BY id DESC");
  $i = 0;
  if ($q->num_rows > 0):
    while($r = $q->fetch_assoc()):
      $img = (!empty($r['foto']) && file_exists(__DIR__ . '/../' . $r['foto'])) 
        ? '../'.$r['foto'] 
        : 'https://via.placeholder.com/800x450?text=Potensi+Desa';
      $reverse = $i % 2 !== 0 ? 'md:flex-row-reverse' : '';
  ?>
  <section class="section" data-bg="<?php echo $img; ?>">
    <div class="section-content <?php echo $reverse; ?>">
      <div class="image-wrapper opacity-0 scale-90">
        <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($r['judul']); ?>">
      </div>
      <div class="section-text opacity-0 translate-y-10">
        <h2><?php echo htmlspecialchars($r['judul']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($r['deskripsi'])); ?></p>
      </div>
    </div>
  </section>
  <?php $i++; endwhile; else: ?>
    <section class="section text-center text-gray-500 italic">
      Belum ada data potensi Kelurahan yang tersedia.
    </section>
  <?php endif; ?>

  <!-- FOOTER SEDERHANA (include) -->
  <?php include 'footer.php'; ?>

  <script>
    // Inisialisasi AOS bila dipakai
    if (typeof AOS !== 'undefined') AOS.init({ duration: 700, once: true });
  </script>
</body>
</html>

  <script>
  gsap.registerPlugin(ScrollTrigger);

  // Navbar shadow effect
  const navbar = document.getElementById("navbar");
  window.addEventListener("scroll", () => {
    navbar.classList.toggle("shadow-md", window.scrollY > 50);
  });

  // Hero animation
  gsap.to(".hero h1", {opacity: 1, y: 0, duration: 1.2, ease: "power3.out"});
  gsap.to(".hero p", {opacity: 1, y: 0, delay: 0.3, duration: 1, ease: "power2.out"});

  // Reveal section content animation
  gsap.utils.toArray(".section-content").forEach((sec) => {
    const img = sec.querySelector(".image-wrapper");
    const text = sec.querySelector(".section-text");

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: sec,
        start: "top 85%",
        toggleActions: "play none none reverse"
      }
    });

    tl.to(img, {opacity: 1, scale: 1, duration: 1.2, ease: "power3.out"})
      .to(text, {opacity: 1, y: 0, duration: 1, ease: "power2.out"}, "-=0.5");
  });

  // 🌿 Background image changes only when image is at the center of viewport
  const sections = document.querySelectorAll(".section");
  let currentBG = null;
  let timeout;

  sections.forEach((section) => {
    const imgEl = section.querySelector(".image-wrapper img");
    const bg = section.dataset.bg;

    // Buat ScrollTrigger berdasarkan posisi gambar
    ScrollTrigger.create({
      trigger: imgEl,
      start: "center 70%", // aktif saat gambar mulai mendekati tengah viewport
      end: "center 30%",   // berhenti setelah gambar melewati tengah layar
      onEnter: () => smoothChangeBG(bg),
      onEnterBack: () => smoothChangeBG(bg),
      onLeave: () => stopTransition(), // ketika gambar mulai keluar layar
      onLeaveBack: () => stopTransition(),
      markers: false
    });
  });

  // Fungsi smooth background transition
  function smoothChangeBG(image) {
    if (currentBG === image) return;
    currentBG = image;

    clearTimeout(timeout);
    timeout = setTimeout(() => {
      gsap.to("body", {
        backgroundImage: `url(${image})`,
        duration: 1.5,
        ease: "power2.inOut",
        overwrite: true,
      });
    }, 150); // buffer 150ms agar lebih stabil
  }

  // Fungsi untuk menghentikan transisi agar tidak glitch
  function stopTransition() {
    clearTimeout(timeout);
  }

  // Overlay hijau lembut khas brand desa
  const overlay = document.createElement("div");
  overlay.classList.add("bg-overlay");
  document.body.appendChild(overlay);

  gsap.set(overlay, {
    position: "fixed",
    top: 0, left: 0,
    width: "100%", height: "100%",
    background: "linear-gradient(rgba(13,95,63,0.18), rgba(0,0,0,0.25))",
    pointerEvents: "none",
    zIndex: 1
  });

  // Fade-in smooth pada hero saat load
  window.addEventListener("load", () => {
    gsap.to("body", {opacity: 1, duration: 1.2, ease: "power2.out"});
  });
</script>
</body>
</html>
