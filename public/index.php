<?php
include_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelurahan Talikuran Utara</title>

  <!-- ✅ Tambahkan favicon -->
  <link rel="icon" href="https://talikuranutara.com/favicon.png" type="image/png">
  <link rel="shortcut icon" href="https://talikuranutara.com/favicon.png" type="image/png">
  <link rel="icon" type="image/png" href="assets/logo.png" sizes="48x48">
  <link rel="apple-touch-icon" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">

  <!-- TailwindCSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">

  <!-- ✅ Tambahkan ini di HEAD -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Font & Custom Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
            merriweather: ['Merriweather', 'serif']
          },
          colors: {
            background: 'hsl(135,20%,96.1%)',
            card: 'hsl(0,0%,100%)',
            foreground: 'hsl(240,10%,3.9%)',
            muted: 'hsl(240,5%,45.1%)',
            primary: 'hsl(130,30%,30%)',
            primaryForeground: 'hsl(0,0%,98%)',
            border: 'hsl(135,20%,88%)'
          }
        }
      }
    }
  </script>

  <!-- Scroll Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <style>
  /* Pastikan setiap anchor section tidak “ketutup” navbar */
  [id] { scroll-margin-top: 90px; }

  /* Amankan footer & wave agar tidak overlap konten sebelumnya */
  footer { position: relative; z-index: 1; }
  section, header { position: relative; z-index: 2; }

  /* Hilangkan sisa overflow aneh */
  html, body { overflow-x: hidden; }

  /* Kalau ada container tinggi 0 karena float/overflow: */
  .clearfix::after { content: ""; display: table; clear: both; }
</style>

</head>

<body class="font-poppins bg-background text-foreground">

<?php include 'header.php'; ?>

<!-- ✨ Script Interaksi Navbar -->
<script>
  const navbar = document.getElementById("navbar");
  const links = document.querySelectorAll(".nav-link");
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  // Scroll effect - ubah warna navbar saat scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("bg-white/90", "backdrop-blur-lg", "shadow-md");
    } else {
      navbar.classList.remove("bg-white/90", "backdrop-blur-lg", "shadow-md");
    }
  });

  // Smooth scroll ke section
  links.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      const target = document.querySelector(link.getAttribute("href"));
      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
        // Tutup menu mobile setelah klik
        mobileMenu.classList.add("hidden");
      }
    });
  });

  // Mobile menu toggle
  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    menuBtn.classList.toggle("text-primary");
  });
</script>

<!-- 🌿 Hero Section — GSAP Dual Line + Gradient Text + Smooth Cinematic Scroll -->
<section id="home" class="relative h-screen flex items-center justify-center overflow-hidden bg-black text-white">

  <!-- 🔸 Background -->
  <div class="absolute inset-0 hero-bg bg-cover bg-center transition-transform duration-500 ease-out"
    style="background-image: url('assets/gambarutama.png'); will-change: transform;">
  </div>

  <!-- 🔸 Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent"></div>

  <!-- 🔸 Hero Content -->
  <div class="relative z-10 text-center px-6">
    <h1 id="hero-line1" class="text-4xl md:text-6xl font-merriweather font-bold leading-snug"></h1>
    <h2 id="hero-line2" class="text-4xl md:text-6xl font-merriweather font-bold leading-snug mt-2"></h2>

    <p id="hero-subtitle" class="text-lg md:text-xl mt-6 text-green-100 drop-shadow-[0_0_10px_rgba(0,255,180,0.4)]">
      Menjadi Kelurahan mandiri, maju, dan sejahtera melalui potensi masyarakat dan alam.
    </p>

    <a id="scrollBtn" href="#profil" 
       class="inline-block mt-10 bg-green-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-900 hover:scale-105 active:scale-95 transition-all duration-500 shadow-lg">
      Jelajahi Kelurahan <i class="bi bi-arrow-down-circle ml-2"></i>
    </a>
  </div>
</section>

<!-- 🎬 GSAP Animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollToPlugin);

  const bg = document.querySelector(".hero-bg");
  const line1 = document.getElementById("hero-line1");
  const line2 = document.getElementById("hero-line2");
  const scrollBtn = document.getElementById("scrollBtn");

  // 🔹 Baris pertama
  const words1 = ["Selamat", "Datang", "di", "Website", "Resmi"];
  // 🔹 Baris kedua
  const words2 = ["Kelurahan", "Talikuran", "Utara"];

  // Buat span untuk setiap kata di line 1
  words1.forEach((word) => {
    const span = document.createElement("span");
    span.textContent = word + " ";
    span.style.display = "inline-block";
    span.classList.add("word");
    line1.appendChild(span);
  });

  // Buat span untuk setiap kata di line 2 (gradient)
  words2.forEach((word) => {
    const span = document.createElement("span");
    span.textContent = word + " ";
    span.style.display = "inline-block";
    span.classList.add("word", "gradient-green");
    line2.appendChild(span);
  });

  const spans1 = gsap.utils.toArray("#hero-line1 .word");
  const spans2 = gsap.utils.toArray("#hero-line2 .word");

  // 🔹 Animasi Intro
  const intro = gsap.timeline();
  intro
    .from(spans1, {
      duration: 1.1,
      opacity: 0,
      y: -50,
      rotationX: -90,
      transformOrigin: "bottom center",
      stagger: 0.1,
      ease: "back.out(1.7)"
    })
    .from(spans2, {
      duration: 1.1,
      opacity: 0,
      y: -50,
      rotationX: -90,
      transformOrigin: "bottom center",
      stagger: 0.1,
      ease: "back.out(1.7)"
    }, "-=0.4");

  // 🔹 Parallax Background
  document.addEventListener("mousemove", (e) => {
    const x = (e.clientX / window.innerWidth - 0.5) * 20;
    const y = (e.clientY / window.innerHeight - 0.5) * 20;
    gsap.to(bg, { x: -x, y: -y, scale: 1.1, duration: 1.2, ease: "power2.out" });
  });

  // 🔹 Magnetik interaktif (gabungan line 1 & 2)
  const allSpans = [...spans1, ...spans2];
  let bounds = document.querySelector("#hero-line1").getBoundingClientRect();

  const handleMouseMove = (e) => {
    const mouseX = e.clientX - bounds.left;
    const mouseY = e.clientY - bounds.top;

    allSpans.forEach((span) => {
      const rect = span.getBoundingClientRect();
      const centerX = rect.left + rect.width / 2 - bounds.left;
      const centerY = rect.top + rect.height / 2 - bounds.top;
      const dx = mouseX - centerX;
      const dy = mouseY - centerY;
      const distance = Math.sqrt(dx * dx + dy * dy);
      const force = Math.max(0, 130 - distance);

      if (force > 0) {
        const angle = Math.atan2(dy, dx);
        const moveX = Math.cos(angle) * -force * 0.35;
        const moveY = Math.sin(angle) * -force * 0.35;
        gsap.to(span, {
          x: moveX, y: moveY, rotationX: -moveY / 3, rotationY: moveX / 3,
          scale: 1.08, duration: 0.35, ease: "power2.out"
        });
      } else {
        gsap.to(span, {
          x: 0, y: 0, rotationX: 0, rotationY: 0, scale: 1,
          duration: 0.6, ease: "elastic.out(1, 0.4)"
        });
      }
    });
  };

  const handleMouseLeave = () => {
    gsap.to(allSpans, {
      x: 0, y: 0, rotationX: 0, rotationY: 0, scale: 1,
      duration: 1.2, ease: "elastic.out(1, 0.4)", stagger: 0.05
    });
    gsap.to(bg, { x: 0, y: 0, duration: 1.5, ease: "power3.out" });
  };

  line1.addEventListener("mousemove", handleMouseMove);
  line2.addEventListener("mousemove", handleMouseMove);
  line1.addEventListener("mouseleave", handleMouseLeave);
  line2.addEventListener("mouseleave", handleMouseLeave);

  // 🔹 Efek Scroll Cinematic
  scrollBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const target = document.querySelector("#profil");
    if (!target) return;

    const tl = gsap.timeline({ defaults: { ease: "power3.inOut" } });
    tl.to([line1, line2, "#hero-subtitle"], {
      y: -40,
      opacity: 0.5,
      duration: 0.7,
      stagger: 0.1
    })
      .to(".hero-bg", { scale: 1.15, opacity: 0.85, duration: 0.9 }, "<")
      .to(window, {
        duration: 1.8,
        scrollTo: { y: target, offsetY: -60, autoKill: true },
        ease: "power2.inOut"
      }, "+=0.1")
      .to(".hero-bg", { scale: 1, opacity: 1, duration: 1 }, "-=0.6")
      .to([line1, line2], { opacity: 1, y: 0, duration: 0.8, ease: "power2.out" }, "-=0.6");
  });
});
</script>

<!-- ✨ Styling -->
<style>
#hero-line1 span, #hero-line2 span {
  color: #ffffff;
  font-weight: 800;
  letter-spacing: 1px;
  text-shadow: 0 0 15px rgba(0, 255, 120, 0.6);
  transition: text-shadow 0.3s ease;
}

#hero-line1 .word,
#hero-line2 .word {
  display: inline-block;
  margin-right: 0.5ch; /* ✅ Menambahkan spasi antar kata */
}

.gradient-green {
  background: linear-gradient(90deg, #22c55e, #86efac, #16a34a, #4ade80);
  background-size: 300% 300%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientShift 5s ease-in-out infinite;
  text-shadow: 0 0 20px rgba(34, 197, 94, 0.6);
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
#hero-line1 span:hover, #hero-line2 span:hover {
  text-shadow: 0 0 22px rgba(50, 255, 180, 1);
}
@media (max-width: 640px) {
  #hero-line1, #hero-line2 {
    font-size: 2.3rem;
    line-height: 2.6rem;
  }
}
</style>

<!-- 🔹 Profil Kelurahan (Sinkron dari Database dengan Auto Height dan Rata Kiri-Kanan) -->
<section id="profil" class="py-20 bg-[#f8faf8] overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 text-center">
    
    <!-- Judul Section -->
    <div class="flex justify-center items-center gap-2 mb-10" data-aos="fade-down">
      <i class="bi bi-info-circle text-green-700 text-3xl"></i>
      <h2 class="text-3xl md:text-4xl font-merriweather font-bold text-green-900">
        Profil Kelurahan Talikuran Utara
      </h2>
    </div>

    <?php
    include_once __DIR__ . '/../config/config.php';
    $profil = $conn->query("SELECT * FROM profil_desa ORDER BY id ASC");

    if ($profil && $profil->num_rows > 0) {
      echo '<div class="grid md:grid-cols-2 gap-10 mb-16 items-start auto-rows-auto">';
      $delay = 0;

      while ($row = $profil->fetch_assoc()) {
        $delay += 100;
        $judul = htmlspecialchars($row['judul']);
        $isi   = nl2br(htmlspecialchars($row['isi'])); // ubah \n jadi <br> untuk teks biasa

        echo "
        <article 
          class='relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 transition-all duration-500 transform hover:-translate-y-1 group border border-green-100 text-left h-auto'
          data-aos='fade-up' data-aos-delay='$delay'>
          
          <div class='absolute inset-0 bg-gradient-to-br from-green-100/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 rounded-2xl'></div>
          
          <div class='relative z-10'>
            <div class='flex items-center gap-3 mb-4'>
              <i class='bi bi-book text-green-700 text-2xl'></i>
              <h3 class='font-semibold text-2xl text-green-800 font-merriweather'>$judul</h3>
            </div>

            <p class='text-gray-700 leading-relaxed text-justify'>
              $isi
            </p>
          </div>
        </article>";
      }

      echo '</div>';
    } else {
      echo "
      <div class='text-center text-gray-500 mt-10' data-aos='fade-up'>
        <i class='bi bi-exclamation-circle text-4xl text-gray-400 mb-3'></i>
        <p>Belum ada data profil Kelurahan yang tersedia.</p>
      </div>";
    }
    ?>
  </div>
</section>

<!-- ✨ Styling tambahan -->
<style>
/* Tambahkan kesan lembut dan keterbacaan tinggi */
.text-justify {
  text-align: justify;
  text-justify: inter-word;
}
article:hover h3 {
  color: #15803d; /* hijau tua saat hover */
}
</style>

<!-- 🔹 Struktur Pemerintahan – Cinematic Living Edition -->
<section id="struktur" class="py-24 bg-gradient-to-b from-green-50 to-green-100 overflow-hidden relative">
  <div class="max-w-7xl mx-auto px-6">
    <!-- Judul -->
    <div class="text-center mb-16">
      <h2 class="text-5xl font-serif font-bold text-green-900 tracking-tight mb-2">Struktur Pemerintahan</h2>
      <p class="text-gray-600 text-lg">Kelurahan Talikuran Utara</p>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-12 relative">
      <!-- 🎞️ Panel Kiri - Gambar Utama -->
      <div class="w-full md:w-1/2 relative" id="mainImageContainer">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl neon-border transition-all duration-700">
          <div id="lightOverlay" class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.15)_0%,transparent_70%)] opacity-0 pointer-events-none transition-opacity duration-500"></div>
          <img id="mainImage" src="assets/default.png" alt="Struktur" 
               class="w-full h-[480px] object-cover opacity-0 scale-105 transition-all duration-1000 ease-in-out rounded-3xl">
          <!-- Tekstur Film Grain -->
          <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/noise.png')] opacity-30 mix-blend-overlay"></div>
          <!-- Overlay Gradasi -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>
          <!-- Nama & Jabatan -->
          <div class="absolute bottom-10 left-8">
            <h3 id="mainName" class="text-white text-4xl font-bold tracking-tight mb-2 opacity-0 drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]"></h3>
            <p id="mainRole" class="text-green-300 text-xl font-medium opacity-0 drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]"></p>
          </div>
        </div>
      </div>

      <!-- 🧩 Slider Thumbnail -->
      <div class="w-full md:w-1/2 relative">
        <div class="swiper cinematicSwiper">
          <div class="swiper-wrapper">
            <?php
            include_once __DIR__ . '/../config/config.php';
            $struktur = $conn->query("SELECT * FROM struktur_pemerintahan ORDER BY urutan ASC");
            if ($struktur && $struktur->num_rows > 0) {
              while ($row = $struktur->fetch_assoc()) {
                $fotoPath = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto']))
                  ? "../" . $row['foto']
                  : "assets/default.png";

                echo "
                <div class='swiper-slide cursor-pointer group' 
                     data-foto=\"$fotoPath\" 
                     data-nama=\"" . htmlspecialchars($row['nama']) . "\" 
                     data-jabatan=\"" . htmlspecialchars($row['jabatan']) . "\">
                  <div class='relative rounded-2xl overflow-hidden shadow-md bg-white/90 backdrop-blur-md border-2 border-transparent transition-all duration-700 group-hover:border-green-400/80'>
                    <img src=\"$fotoPath\" alt=\"" . htmlspecialchars($row['nama']) . "\" 
                         class='w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700 ease-out'>
                    <div class='absolute inset-0 bg-black/50 group-hover:bg-black/30 transition-all duration-700'></div>
                    <div class='absolute bottom-4 left-0 w-full text-center'>
                      <h4 class='text-white text-lg font-semibold drop-shadow-md'>" . htmlspecialchars($row['nama']) . "</h4>
                      <p class='text-green-300 text-xs uppercase tracking-wider'>" . htmlspecialchars($row['jabatan']) . "</p>
                    </div>
                  </div>
                </div>";
              }
            } else {
              echo "<p class='text-gray-500 text-center w-full py-10'>Belum ada data struktur pemerintahan.</p>";
            }
            ?>
          </div>
        </div>

        <!-- 🔘 Navigasi -->
        <div class="absolute -bottom-14 left-1/2 transform -translate-x-1/2 flex gap-8">
          <button id="prev" class="border border-green-800 text-green-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-800 hover:text-white transition-all duration-300 shadow-md hover:shadow-green-300/30">
            <i class="bi bi-chevron-left text-2xl"></i>
          </button>
          <button id="next" class="border border-green-800 text-green-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-800 hover:text-white transition-all duration-300 shadow-md hover:shadow-green-300/30">
            <i class="bi bi-chevron-right text-2xl"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 🌀 Dependencies -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<!-- 🎞️ Cinematic + Interactive Animation Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const mainImage = document.getElementById("mainImage");
  const mainName = document.getElementById("mainName");
  const mainRole = document.getElementById("mainRole");
  const container = document.getElementById("mainImageContainer");
  const lightOverlay = document.getElementById("lightOverlay");

  const swiper = new Swiper(".cinematicSwiper", {
    slidesPerView: 2,
    spaceBetween: 25,
    grabCursor: true,
    centeredSlides: true,
    navigation: { nextEl: "#next", prevEl: "#prev" },
    loop: true,
    speed: 1000,
    breakpoints: {
      768: { slidesPerView: 2.2 },
      1024: { slidesPerView: 3.2 }
    },
    on: {
      init() {
        const first = this.slides[this.activeIndex];
        if (first && first.dataset.foto)
          updateMain(first.dataset.foto, first.dataset.nama, first.dataset.jabatan);
      },
      slideChangeTransitionStart() {
        const active = this.slides[this.activeIndex];
        if (active && active.dataset.foto)
          updateMain(active.dataset.foto, active.dataset.nama, active.dataset.jabatan);
      }
    }
  });

// ✨ Animasi Huruf per Huruf + Neon Glow (Cinematic Edition)
function animateText(element, text, delay = 0) {
  element.innerHTML = "";
  const chars = Array.from(text); // mempertahankan spasi & karakter unik

  chars.forEach((char, i) => {
    const span = document.createElement("span");
    span.textContent = char === " " ? "\u00A0" : char; // tampilkan spasi nyata
    span.style.opacity = 0;
    span.style.display = "inline-block";
    span.style.transform = "translateY(20px)";
    span.style.filter = "drop-shadow(0 0 0px #4ade80)";
    element.appendChild(span);

    // Animasi muncul huruf
    gsap.to(span, {
      opacity: 1,
      y: 0,
      delay: delay + i * 0.05,
      duration: 0.4,
      ease: "power3.out",
      onStart: () => {
        // Efek neon glow pulse ketika huruf muncul
        gsap.to(span, {
          filter: "drop-shadow(0 0 8px #4ade80)",
          duration: 0.25,
          yoyo: true,
          repeat: 1,
          ease: "sine.inOut"
        });
      }
    });
  });
}

  function updateMain(foto, nama, jabatan) {
    gsap.to(mainImage, { opacity: 0, scale: 1.03, duration: 0.6, ease: "power2.inOut" });
    setTimeout(() => {
      mainImage.src = foto;
      gsap.fromTo(mainImage, { opacity: 0, scale: 1.08 }, { opacity: 1, scale: 1, duration: 1.3, ease: "power4.out" });
    }, 400);

    gsap.to([mainName, mainRole], { opacity: 0, y: 10, duration: 0.3 });
    setTimeout(() => {
      animateText(mainName, nama);
      mainRole.textContent = jabatan;
      gsap.to([mainName, mainRole], {
        opacity: 1, y: 0, delay: 0.5, duration: 0.8, ease: "power3.out"
      });
    }, 400);
  }

  // 🟢 Efek Parallax + Cahaya Interaktif
  container.addEventListener("mousemove", (e) => {
    const rect = container.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const moveX = (x - centerX) / 40;
    const moveY = (y - centerY) / 40;

    gsap.to(mainImage, { x: moveX, y: moveY, scale: 1.03, duration: 0.5, ease: "power2.out" });
    gsap.to(lightOverlay, {
      background: `radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.18) 0%, transparent 70%)`,
      opacity: 1,
      duration: 0.4
    });
  });

  container.addEventListener("mouseleave", () => {
    gsap.to(mainImage, { x: 0, y: 0, scale: 1, duration: 0.8, ease: "power3.out" });
    gsap.to(lightOverlay, { opacity: 0, duration: 0.6 });
  });

  document.addEventListener("click", (e) => {
    const card = e.target.closest(".swiper-slide");
    if (card && card.dataset.foto)
      updateMain(card.dataset.foto, card.dataset.nama, card.dataset.jabatan);
  });

  gsap.to(mainImage, { opacity: 1, scale: 1, duration: 1.2, ease: "power2.out" });
});
</script>

<!-- 🌿 Style -->
<style>
#struktur {
  background: linear-gradient(to bottom right, #f9fafb, #ecfdf5);
}
.swiper {
  padding-bottom: 70px;
}
.swiper-slide {
  filter: blur(1px) brightness(0.7);
  transition: all 0.7s ease;
}
.swiper-slide-active {
  filter: brightness(1) blur(0);
  transform: scale(1.05);
  border: 2px solid #16a34a44;
  box-shadow: 0 0 20px #16a34a55;
}
.neon-border {
  border: 3px solid rgba(34, 197, 94, 0.25);
  box-shadow: 0 0 35px rgba(34, 197, 94, 0.25), inset 0 0 15px rgba(34, 197, 94, 0.15);
  transition: box-shadow 0.5s ease;
}
.neon-border:hover {
  box-shadow: 0 0 45px rgba(34, 197, 94, 0.4), inset 0 0 20px rgba(34, 197, 94, 0.2);
}
@media (max-width: 768px) {
  #mainImage {
    height: 340px;
  }
}
</style>

<!-- 🌾 POTENSI UNGGULAN Kelurahan -->
<section id="potensi" class="py-24 bg-gray-50 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 md:grid md:grid-cols-2 gap-12 items-start">

    <!-- 🟩 Kolom Kiri: Daftar Potensi dari DB -->
    <div class="space-y-6 relative z-10">
      <h2 class="text-3xl font-merriweather font-bold text-green-900 mb-8 flex items-center gap-2">
        <i class="bi bi-activity text-green-700 text-3xl"></i>
        Potensi Unggulan Kelurahan
      </h2>

      <div class="potensi-list space-y-5">
        <?php
        include_once(__DIR__ . '/../config/config.php');
        // hanya tampilkan 4 potensi terbaru
        $result = $conn->query("SELECT * FROM potensi ORDER BY id DESC LIMIT 3");
        if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
            $img = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto'])) 
                    ? '../' . $row['foto'] 
                    : 'https://via.placeholder.com/800x500?text=Potensi+Desa';
        ?>
          <div class="potensi-item bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 p-6 cursor-pointer relative group border border-transparent hover:border-green-200"
               data-img="<?php echo htmlspecialchars($img); ?>"
               data-desc="<?php echo htmlspecialchars(strip_tags($row['deskripsi'])); ?>">

            <div class="flex items-center justify-between">
              <h3 class="text-lg md:text-xl font-semibold text-green-800 flex items-center gap-2 mb-2">
                <i class="bi bi-leaf-fill text-green-600 text-xl"></i>
                <?php echo htmlspecialchars($row['judul']); ?>
              </h3>
              <i class="bi bi-chevron-right text-green-600 opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
            </div>

            <p class="desc text-gray-600 text-sm mt-2 opacity-0 max-h-0 overflow-hidden transition-all duration-700 ease-in-out">
              <?php echo htmlspecialchars(substr(strip_tags($row['deskripsi']), 0, 180)); ?>...
            </p>

            <!-- Progress Bar -->
            <div class="progress-bar mt-3 h-1 bg-green-100 rounded-full overflow-hidden hidden">
              <div class="progress-fill bg-green-600 h-full w-0 transition-all duration-[5000ms]"></div>
            </div>

            <!-- Tombol Lihat Selengkapnya -->
            <a href="potensi_all.php#<?php echo urlencode(strtolower(str_replace(' ', '-', $row['judul']))); ?>" 
               class="lihat-btn mt-4 inline-block text-sm font-semibold text-green-700 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
               Lihat Selengkapnya <i class="bi bi-arrow-right ml-1"></i>
            </a>
          </div>
        <?php endwhile; else: ?>
          <p class="text-gray-500 italic">Belum ada data potensi tersedia.</p>
        <?php endif; ?>
      </div>

      <!-- 🔗 Tombol Lihat Semua Potensi -->
      <div class="mt-10 text-center md:text-left">
        <a href="potensi_all.php" 
           class="inline-flex items-center gap-2 bg-green-700 text-white px-6 py-3 rounded-full font-semibold shadow-md hover:bg-green-800 hover:shadow-lg transition-all duration-300">
          <i class="bi bi-arrow-right-circle text-lg"></i> Lihat Semua Potensi
        </a>
      </div>
    </div>

    <!-- 🖼️ Kolom Kanan: Sticky Gambar -->
    <div class="relative mt-10 md:mt-0" data-aos="fade-left">
      <div class="sticky top-24 overflow-hidden rounded-3xl shadow-2xl h-[380px] md:h-[500px] transform transition-all duration-700 ease-out hover:scale-[1.02]">
        <img id="potensiImage" src="" alt="Potensi Kelurahan"
             class="absolute inset-0 w-full h-full object-cover opacity-100 transition-all duration-700 ease-in-out">
      </div>
    </div>
  </div>
</section>

<!-- 🌿 STYLE TAMBAHAN -->
<style>
  .potensi-item.active {
    background-color: #ecfdf5;
    transform: scale(1.03);
    border-color: #10b981;
  }
  .potensi-item.active h3 { color: #065f46; }
  .fade-out { opacity: 0; transform: scale(0.98); }
  .fade-in { opacity: 1; transform: scale(1); }
  .lihat-btn:hover {
    color: #16a34a;
    text-shadow: 0 0 10px rgba(34,197,94,0.4);
  }
  @media (max-width: 768px) {
    .potensi-item { padding: 1rem; }
  }
</style>

<!-- ⚙️ SCRIPT ANIMASI GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
  gsap.registerPlugin(ScrollTrigger);

  const items = document.querySelectorAll('.potensi-item');
  const image = document.getElementById('potensiImage');
  let activeIndex = 0;
  let autoPlay;

  // 🌿 Fungsi aktifkan item
  function activateItem(index) {
    items.forEach((item, i) => {
      const desc = item.querySelector('.desc');
      const fill = item.querySelector('.progress-fill');
      const bar = item.querySelector('.progress-bar');

      if (i === index) {
        item.classList.add('active');
        desc.style.opacity = 1;
        desc.style.maxHeight = '300px';
        bar.classList.remove('hidden');
        fill.style.width = '0%';
        setTimeout(() => (fill.style.width = '100%'), 50);

        const newImg = item.dataset.img;
        if (newImg && image.src !== newImg) {
          gsap.to(image, { opacity: 0, scale: 1.05, duration: 0.6, onComplete: () => {
            image.src = newImg;
            gsap.fromTo(image, { scale: 1.05, opacity: 0 }, { scale: 1, opacity: 1, duration: 1, ease: "power2.out" });
          }});
        }
      } else {
        item.classList.remove('active');
        desc.style.opacity = 0;
        desc.style.maxHeight = '0';
        fill.style.width = '0%';
        bar.classList.add('hidden');
      }
    });
  }

  // 🔁 Autoplay dengan GSAP timeline
  function startAutoPlay() {
    autoPlay = gsap.timeline({ repeat: -1, repeatDelay: 0 });
    items.forEach((item, i) => {
      autoPlay.to({}, { duration: 0.1, onStart: () => activateItem(i) })
              .to({}, { duration: 5 });
    });
  }

  // 🖱️ Hover manual
  items.forEach((item, i) => {
    item.addEventListener('mouseenter', () => {
      gsap.killTweensOf(autoPlay);
      activateItem(i);
    });
    item.addEventListener('mouseleave', () => {
      startAutoPlay();
    });
  });

  // 🔹 Animasi masuk saat scroll
  items.forEach((item) => {
    gsap.from(item, {
      scrollTrigger: {
        trigger: item,
        start: "top 90%",
        toggleActions: "play none none reverse",
      },
      opacity: 0,
      y: 50,
      duration: 0.8,
      ease: "power2.out"
    });
  });

  // 🎬 Jalankan pertama kali
  if (items.length > 0) {
    image.src = items[0].dataset.img;
    activateItem(0);
    startAutoPlay();
  }
</script>



<!-- 🔹 Berita -->
<section id="berita" class="py-20 bg-background relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6">
    <!-- Judul Bagian -->
    <div class="flex justify-center items-center gap-3 mb-10 animate-slideDown">
      <i class="bi bi-newspaper text-green-700 text-3xl"></i>
      <h2 class="text-3xl font-merriweather font-bold text-green-900">Berita & Kegiatan</h2>
    </div>

    <!-- Grid Berita -->
    <div class="grid md:grid-cols-3 gap-8">
      <?php
      $query = $conn->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3");
      while ($row = $query->fetch_assoc()) {
        $gambarPath = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto']))
          ? "../" . $row['foto']
          : "https://via.placeholder.com/400x250?text=No+Image";

        echo "
        <div class='relative group bg-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-700 overflow-hidden flex flex-col justify-between transform hover:translate-y-[-8px] hover:rotate-[0.5deg] hover:scale-[1.02] animate-floatUp'>
          <!-- Gambar -->
          <div class='relative overflow-hidden'>
            <img src='$gambarPath' alt='Gambar Berita' 
                 class='w-full h-52 object-cover transition-transform duration-[1600ms] ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:scale-110 group-hover:rotate-1'>
            <div class='absolute inset-0 bg-gradient-to-t from-black/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700'></div>
          </div>

          <!-- Konten -->
          <div class='flex flex-col justify-between flex-grow p-6 text-left'>
            <div>
              <h3 class='font-semibold text-lg mb-2 text-green-900 leading-tight group-hover:text-green-800 transition-colors duration-300'>
                " . htmlspecialchars($row['judul']) . "
              </h3>

              <!-- 📅 Tanggal + Ikon -->
              <div class='flex items-center gap-2 mb-3 text-gray-600 text-sm'>
                <i class='bi bi-calendar-week text-green-700 text-base'></i>
                <span class='align-middle'>" . date('d M Y', strtotime($row['tanggal'])) . "</span>
              </div>

              <p class='text-muted text-sm text-justify mb-4 leading-relaxed'>
                " . substr(strip_tags($row['isi']), 0, 120) . "...
              </p>
            </div>

            <!-- Tombol Baca Selengkapnya -->
            <div class='mt-auto pt-3'>
              <a href='berita_detail.php?id={$row['id']}'
                 class='inline-flex items-center gap-2 text-green-700 font-semibold text-sm border border-green-700 rounded-lg px-4 py-2 hover:bg-green-700 hover:text-white transition-all duration-500 group-hover:translate-y-[-3px] group-hover:shadow-md'>
                Baca Selengkapnya
                <i class='bi bi-arrow-right-short text-lg'></i>
              </a>
            </div>
          </div>
        </div>";
      }
      ?>
    </div>

    <!-- Tombol Semua Berita -->
    <div class="mt-12 text-center animate-bounceSlow">
      <a href="berita_all.php" 
         class="inline-flex items-center gap-2 bg-green-700 text-white px-6 py-3 rounded-full shadow-lg hover:scale-110 hover:bg-green-800 transition-all duration-500">
        <i class="bi bi-collection"></i> Lihat Semua Berita
      </a>
    </div>
  </div>

  <!-- Efek Latar Dinamis -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute w-6 h-6 bg-green-300/30 rounded-full top-10 left-16 animate-pulseOrb"></div>
    <div class="absolute w-8 h-8 bg-green-400/25 rounded-full top-1/2 right-20 animate-pulseOrb delay-[2s]"></div>
    <div class="absolute w-5 h-5 bg-green-200/30 rounded-full bottom-20 left-1/3 animate-pulseOrb delay-[3s]"></div>
  </div>

  <style>
    /* 🌿 Animasi Unik */
    @keyframes floatUp {
      0% { opacity: 0; transform: translateY(40px) scale(0.98); }
      60% { opacity: 1; transform: translateY(-6px) scale(1.02); }
      100% { transform: translateY(0) scale(1); }
    }
    .animate-floatUp { animation: floatUp 1.2s ease-out; }

    @keyframes slideDown {
      0% { opacity: 0; transform: translateY(-25px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-slideDown { animation: slideDown 0.8s ease-out; }

    @keyframes bounceSlow {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
    .animate-bounceSlow { animation: bounceSlow 4s ease-in-out infinite; }

    @keyframes pulseOrb {
      0%, 100% { transform: scale(1); opacity: 0.4; }
      50% { transform: scale(1.3); opacity: 0.7; }
    }
    .animate-pulseOrb { animation: pulseOrb 7s ease-in-out infinite; }
  </style>
</section>

<!-- 🌌 GALERI Kelurahan TALIKURAN UTARA - 3D CIRCULAR GALLERY -->
<section id="galeri" class="py-24 bg-gray-50 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-merriweather font-bold text-green-900 mb-12 flex justify-center items-center gap-2">
      <i class="bi bi-camera-reels-fill text-green-700 text-3xl"></i>
      Galeri Kelurahan Talikuran Utara
    </h2>

    <!-- 🌠 Carousel Wrapper -->
    <div class="gallery-3d relative mx-auto w-full h-[480px] flex justify-center items-center perspective">
      <div id="carousel3D" class="relative w-[300px] h-[200px] transform-style-preserve"></div>
    </div>

    <!-- 🔗 Tombol -->
    <div class="mt-14">
      <a href="galeri_all.php" 
         class="inline-flex items-center gap-2 bg-green-700 text-white px-8 py-3 rounded-full font-semibold shadow-md hover:bg-green-800 hover:scale-105 hover:shadow-xl transition-all duration-500">
        <i class="bi bi-images"></i> Lihat Semua Galeri
      </a>
    </div>
  </div>
</section>

<!-- 🌿 STYLE -->
<style>
  .perspective { perspective: 1500px; }
  .transform-style-preserve { transform-style: preserve-3d; }

  .gallery-card {
    position: absolute;
    width: 260px;
    height: 170px;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    cursor: pointer;
    background: #000;
  }

  .gallery-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1s ease;
  }

  .gallery-card:hover img {
    transform: scale(1.08);
  }

  /* Overlay judul kiri bawah */
  .gallery-info {
    position: absolute;
    bottom: 12px;
    left: 16px;
    color: #fff;
    text-align: left;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
  }

  .gallery-info h4 {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
  }

  .gallery-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
  }

  .gallery-card:hover {
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
  }

  @media (max-width: 768px) {
    .gallery-card { width: 180px; height: 120px; }
    .gallery-info h4 { font-size: 0.85rem; }
  }
</style>

<!-- ⚙️ GSAP SCRIPT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/InertiaPlugin.min.js"></script>

<script>
  // 📸 Ambil data dari database (10 gambar terbaru)
  const dataGaleri = [
    <?php
      include_once(__DIR__ . '/../config/config.php');
      $res = $conn->query("SELECT * FROM galeri ORDER BY id DESC LIMIT 10");
      $first = true;
      while ($row = $res->fetch_assoc()) {
        $path = $row['foto'];
        $judul = addslashes($row['judul']);
        $img = (!empty($path) && file_exists(__DIR__ . '/../' . $path))
          ? '../' . ltrim($path, '/')
          : 'https://via.placeholder.com/600x400?text=Galeri+Desa';
        if (!$first) echo ",";
        echo "{src: '$img', title: '$judul'}";
        $first = false;
      }
    ?>
  ];

  const container = document.getElementById("carousel3D");
  const total = dataGaleri.length;
  const radius = 500;
  let rotationY = 0;
  let autoRotate = true;

  // 🧩 Buat kartu dari gambar dan judul overlay kiri bawah
  dataGaleri.forEach((item, i) => {
    const card = document.createElement("div");
    card.classList.add("gallery-card");
    card.innerHTML = `
      <img src="${item.src}" alt="${item.title}">
      <div class="gallery-info">
        <h4>${item.title}</h4>
      </div>
    `;
    container.appendChild(card);

    const angle = (360 / total) * i;
    gsap.set(card, {
      rotationY: angle,
      transformOrigin: `center center -${radius}px`,
      z: 0,
    });
  });

  // 🔁 Auto-Rotate smooth & infinite
  const spin = gsap.to(container, {
    rotationY: "+=360",
    duration: 50,
    ease: "none",
    repeat: -1,
  });

  // 🖱️ Hover = pause rotasi sementara
  container.addEventListener("mouseenter", () => spin.pause());
  container.addEventListener("mouseleave", () => { if (autoRotate) spin.resume(); });

  // 🖐️ Drag manual (interaktif)
  Draggable.create(container, {
    type: "rotationY",
    inertia: true,
    onDragStart: () => {
      spin.pause();
      autoRotate = false;
    },
    onDrag: function() { rotationY = this.rotationY; },
    onRelease: () => {
      autoRotate = true;
      spin.resume();
    }
  });

  // 🌈 Efek depth & scale dinamis
  const cards = gsap.utils.toArray(".gallery-card");
  gsap.ticker.add(() => {
    cards.forEach(card => {
      const rot = gsap.getProperty(card, "rotationY") + gsap.getProperty(container, "rotationY");
      const depth = Math.cos(gsap.utils.degToRad(rot % 360));
      const scale = gsap.utils.mapRange(-1, 1, 0.65, 1.15, depth);
      const opacity = gsap.utils.mapRange(-1, 1, 0.4, 1, depth);
      gsap.set(card, { scale, opacity });
    });
  });

  // 🎬 Animasi judul utama saat scroll
  gsap.from("#galeri h2", {
    opacity: 0,
    y: -40,
    duration: 1.2,
    ease: "power3.out",
    scrollTrigger: { trigger: "#galeri", start: "top 85%" }
  });
</script>

<!-- 🌍 Peta Administrasi & Fasos-Fasum Sinematik -->
<section id="peta" class="relative py-24 bg-gradient-to-b from-green-50 via-white to-green-100 overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 text-center">

    <!-- Judul -->
    <div class="flex justify-center items-center gap-3 mb-10" data-aos="fade-down">
      <i class="bi bi-geo-alt-fill text-green-700 text-3xl drop-shadow-sm"></i>
      <h2 class="text-4xl font-serif font-bold text-green-900 tracking-tight">
        Peta Interaktif Kelurahan Talikuran Utara
      </h2>
    </div>

    <!-- Tombol Pilihan -->
    <div class="flex justify-center gap-4 mb-8" data-aos="fade-up" data-aos-delay="100">
      <button id="btnAdmin" class="px-5 py-2 bg-green-700 text-white rounded-full font-medium shadow-md hover:bg-green-800 transition-all">
        Peta Administrasi
      </button>
      <button id="btnFasos" class="px-5 py-2 bg-green-100 text-green-700 border border-green-400 rounded-full font-medium shadow-md hover:bg-green-200 transition-all">
        Peta Fasos & Fasum
      </button>
    </div>

    <!-- Container Peta 3D -->
    <div class="relative group perspective max-w-6xl mx-auto" id="petaContainer">
      <div class="relative rounded-3xl overflow-hidden shadow-2xl transform-style-3d neon-frame transition-all duration-[1500ms] ease-[cubic-bezier(0.23,1,0.32,1)]" id="petaCard">
        <!-- Gambar Peta -->
        <img 
          id="petaImage"
          src="assets/Peta_Administrasi.jpg"
          alt="Peta Administrasi Kelurahan Talikuran Utara"
          class="w-full h-auto object-cover select-none pointer-events-none rounded-3xl"
          draggable="false"
        >
        
        <!-- 🔹 Overlay Cahaya Sinematik -->
        <div class="absolute inset-0 bg-gradient-to-tr from-green-900/20 via-transparent to-green-400/10 mix-blend-overlay pointer-events-none"></div>

        <!-- 🔹 Border Neon -->
        <div class="absolute inset-0 rounded-3xl border-[2px] border-green-500/40 shadow-[0_0_45px_rgba(34,197,94,0.3)] animate-breath"></div>
      </div>

      <!-- 🔹 Cahaya Ambient -->
      <div class="absolute -inset-10 blur-[120px] bg-gradient-to-t from-green-200/20 via-green-400/10 to-transparent opacity-30 group-hover:opacity-60 transition-all duration-700"></div>
    </div>

    <!-- Keterangan -->
    <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
      <div id="petaCaption" class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-6 py-3 rounded-full shadow-lg transition-all">
        <i class="bi bi-map text-xl"></i>
        <span class="font-medium">Peta batas wilayah & pembagian administratif Kelurahan Talikuran Utara</span>
      </div>
    </div>
  </div>

  <!-- 🎵 Audio Futuristik -->
  <audio id="hoverSound" src="https://cdn.pixabay.com/download/audio/2023/03/28/audio_7b519a3b4e.mp3?filename=digital-click-soft-110503.mp3" preload="auto"></audio>
  <audio id="ambientSound" src="https://cdn.pixabay.com/download/audio/2023/04/13/audio_4147bfc3f5.mp3?filename=sci-fi-hum-loop-145890.mp3" preload="auto" loop></audio>
  <audio id="hoverPulse" src="https://cdn.pixabay.com/download/audio/2023/05/02/audio_408bf8a8f2.mp3?filename=futuristic-hover-1-14799.mp3" preload="auto"></audio>

  <!-- 🎥 Script Animasi & Interaksi -->
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const petaCard = document.getElementById("petaCard");
    const container = document.getElementById("petaContainer");
    const petaImage = document.getElementById("petaImage");
    const caption = document.getElementById("petaCaption");
    const btnAdmin = document.getElementById("btnAdmin");
    const btnFasos = document.getElementById("btnFasos");

    // 🎧 Suara
    const hoverSound = document.getElementById("hoverSound");
    const ambientSound = document.getElementById("ambientSound");
    const hoverPulse = document.getElementById("hoverPulse");
    let ambientPlaying = false;

    // Mainkan ambient hum saat pertama kali
    if (!ambientPlaying) {
      ambientSound.volume = 0.35;
      ambientSound.play().catch(() => {});
      ambientPlaying = true;
    }

    // 🌀 Efek Tilt 3D Interaktif
    container.addEventListener("mousemove", (e) => {
      const rect = container.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const rotateY = ((x / rect.width) - 0.5) * 15;
      const rotateX = ((y / rect.height) - 0.5) * -15;
      gsap.to(petaCard, {
        rotationY: rotateY,
        rotationX: rotateX,
        transformPerspective: 900,
        transformOrigin: "center",
        duration: 0.5,
        ease: "power2.out"
      });
    });

    container.addEventListener("mouseleave", () => {
      gsap.to(petaCard, {
        rotationY: 0,
        rotationX: 0,
        duration: 1.2,
        ease: "elastic.out(1, 0.4)"
      });
    });

    // 🌈 Efek suara saat hover ke peta
    container.addEventListener("mouseenter", () => {
      hoverPulse.currentTime = 0;
      hoverPulse.volume = 0.4;
      hoverPulse.play().catch(() => {});
    });

    // 🎞️ Efek Fade-in awal
    gsap.fromTo(petaCard,
      { opacity: 0, scale: 1.05, filter: "blur(5px)" },
      { opacity: 1, scale: 1, filter: "blur(0px)", duration: 1.8, ease: "power4.out", delay: 0.2 }
    );

    // 🔁 Fungsi Ganti Peta dengan efek & suara
    function switchMap(type) {
      hoverSound.currentTime = 0;
      hoverSound.volume = 0.5;
      hoverSound.play();

      const fadeOut = gsap.to(petaImage, { opacity: 0, scale: 1.03, duration: 0.6, ease: "power2.inOut" });
      fadeOut.eventCallback("onComplete", () => {
        if (type === "admin") {
          petaImage.src = "assets/Peta_Administrasi.jpg";
          caption.innerHTML = "<i class='bi bi-map text-xl'></i> <span class='font-medium'>Peta batas wilayah & pembagian administratif Kelurahan Talikuran Utara</span>";
          btnAdmin.classList.add("bg-green-700", "text-black");
          btnFasos.classList.remove("bg-green-700", "text-white");
          btnFasos.classList.add("bg-green-100", "text-green-700");
        } else {
          petaImage.src = "assets/Peta_Fasos_Fasum.jpg";
          caption.innerHTML = "<i class='bi bi-geo text-xl'></i> <span class='font-medium'>Peta fasilitas sosial & umum Kelurahan Talikuran Utara</span>";
          btnFasos.classList.add("bg-green-700", "text-black");
          btnAdmin.classList.remove("bg-green-700", "text-white");
          btnAdmin.classList.add("bg-green-100", "text-green-700");
        }

        gsap.fromTo(petaImage,
          { opacity: 0, scale: 1.05, filter: "blur(3px)" },
          { opacity: 1, scale: 1, filter: "blur(0)", duration: 1.2, ease: "power3.out" }
        );
      });
    }

    btnAdmin.addEventListener("click", () => switchMap("admin"));
    btnFasos.addEventListener("click", () => switchMap("fasos"));
  });
  </script>

  <!-- 🌿 Style Tambahan -->
  <style>
  .perspective { perspective: 1200px; }

  @keyframes breathingGlow {
    0%, 100% {
      box-shadow: 0 0 25px rgba(34,197,94,0.2),
                  0 0 55px rgba(34,197,94,0.25) inset;
      border-color: rgba(34,197,94,0.3);
    }
    50% {
      box-shadow: 0 0 55px rgba(34,197,94,0.5),
                  0 0 85px rgba(34,197,94,0.3) inset;
      border-color: rgba(34,197,94,0.45);
    }
  }
  .animate-breath {
    animation: breathingGlow 5s ease-in-out infinite;
  }
  .neon-frame {
    border: 3px solid rgba(34,197,94,0.25);
    box-shadow: 0 0 30px rgba(34,197,94,0.25),
                inset 0 0 20px rgba(34,197,94,0.15);
  }
  </style>
</section>

<?php
// Jalankan PHP di atas agar logika berjalan sebelum HTML
include_once('../config/config.php');

if (isset($_POST['kirim'])) {
    $nama = trim($_POST['nama_pelapor']);
    $kontak = trim($_POST['kontak']);
    $judul = trim($_POST['judul_laporan']);
    $isi = trim($_POST['isi_laporan']);
    $kategori = $_POST['kategori'] ?? 'Lainnya';

    // Validasi input minimal
    if ($nama && $kontak && $judul && $isi) {
        $uploadDir = "../uploads/";
        if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

        $fotoPath = null;
        $videoPath = null;

        if (!empty($_FILES['lampiran']['name'][0])) {
            foreach ($_FILES['lampiran']['name'] as $index => $fileName) {
                $tmp = $_FILES['lampiran']['tmp_name'][$index];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newName = time() . "_" . uniqid() . "." . $ext;
                $filePath = $uploadDir . $newName;

                if (move_uploaded_file($tmp, $filePath)) {
                    if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                        $fotoPath = $filePath;
                    } elseif (in_array($ext, ['mp4','mov','avi','webm','mkv'])) {
                        $videoPath = $filePath;
                    } else {
                        // selain gambar/video, tetap disimpan di kolom foto
                        $fotoPath = $filePath;
                    }
                }
            }
        }

        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO laporan 
          (nama_pelapor, kontak, judul_laporan, isi_laporan, kategori, foto, video, status, tanggal)
          VALUES (?, ?, ?, ?, ?, ?, ?, 'baru', NOW())");
        $stmt->bind_param("sssssss", $nama, $kontak, $judul, $isi, $kategori, $fotoPath, $videoPath);
        $stmt->execute();

        // Beri alert sukses
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Laporan Terkirim!',
            text: 'Terima kasih, laporan Anda akan segera ditinjau oleh Admin Kelurahan.',
            confirmButtonColor: '#16a34a',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.href = 'index.php#lapor';
          });
        </script>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
          Swal.fire({
            icon: 'warning',
            title: 'Lengkapi Formulir!',
            text: 'Pastikan semua data telah diisi dengan benar.',
            confirmButtonColor: '#f59e0b'
          });
        </script>";
    }
}
?>

<!-- 🌙 LAPOR WARGA - Aurora Green Night Final -->
<section id="lapor" class="relative py-20 bg-[#0b1f16] overflow-hidden">
  <!-- Aurora Background -->
  <div class="absolute inset-0 bg-gradient-to-b from-[#0f3324] via-[#102c20] to-[#07130d]"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(0,255,150,0.15),transparent_60%),radial-gradient(circle_at_80%_70%,rgba(40,200,100,0.25),transparent_60%)] animate-aurora"></div>

  <!-- Bintang -->
  <div class="absolute inset-0 overflow-hidden" id="starfield"></div>

  <div class="relative max-w-4xl mx-auto px-6 text-center text-white z-10">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-3 flex justify-center items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,150,0.4)]">
      <i class="bi bi-megaphone-fill text-emerald-400"></i> Lapor Warga
    </h2>
    <p class="text-emerald-100 text-base md:text-lg mb-12 max-w-2xl mx-auto leading-relaxed">
      Sampaikan laporan, aspirasi, atau aduan Anda agar dapat segera ditindaklanjuti oleh Kelurahan Talikuran Utara.
    </p>

    <!-- Glass Form -->
    <div class="relative bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl px-8 py-10 shadow-[0_0_50px_rgba(0,255,180,0.15)] transition-all duration-700 hover:shadow-[0_0_60px_rgba(0,255,180,0.25)]">
      <form method="POST" enctype="multipart/form-data" id="laporForm" class="space-y-6 text-left">

        <!-- Nama & Kontak -->
        <div class="grid md:grid-cols-2 gap-6">
          <div class="relative group">
            <i class="bi bi-person-fill form-icon"></i>
            <input type="text" name="nama_pelapor" required class="lapor-input" placeholder="Nama Pelapor">
          </div>
          <div class="relative group">
            <i class="bi bi-envelope-fill form-icon"></i>
            <input type="text" name="kontak" required class="lapor-input" placeholder="Email atau Nomor Telepon">
          </div>
        </div>

        <!-- Judul -->
        <div class="relative group">
          <i class="bi bi-pencil-square form-icon"></i>
          <input type="text" name="judul_laporan" required class="lapor-input" placeholder="Judul Laporan (contoh: Jalan rusak di RT 02)">
        </div>

        <!-- Deskripsi -->
        <div class="relative group">
          <i class="bi bi-chat-dots-fill form-icon-top"></i>
          <textarea name="isi_laporan" rows="5" required class="lapor-input resize-none lapor-textarea" placeholder="Deskripsikan laporan Anda dengan jelas..."></textarea>
        </div>

        <!-- Kategori -->
        <div class="relative group">
          <i id="kategoriIcon" class="bi bi-tag-fill form-icon"></i>
          <select id="kategoriSelect" name="kategori" class="lapor-input kategori-select">
            <option value="" data-color="#9ca3af">Pilih Kategori</option>
            <option value="Infrastruktur" data-color="#facc15">Infrastruktur</option>
            <option value="Lingkungan" data-color="#22c55e">Lingkungan</option>
            <option value="Keamanan" data-color="#3b82f6">Keamanan</option>
            <option value="Sarana Publik" data-color="#a855f7">Sarana Publik</option>
            <option value="Pendidikan" data-color="#f97316">Pendidikan</option>
            <option value="Kesehatan" data-color="#ef4444">Kesehatan</option>
            <option value="Ekonomi & Usaha" data-color="#10b981">Ekonomi & Usaha</option>
            <option value="Sosial" data-color="#ec4899">Sosial</option>
            <option value="Lainnya" data-color="#9ca3af">Lainnya</option>
          </select>
        </div>

        <!-- Upload -->
        <div class="relative group text-center">
          <label class="upload-btn bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white shadow-lg">
            <i class="bi bi-paperclip text-lg"></i> Upload Lampiran (Foto, Video, Dokumen, dll)
            <input type="file" name="lampiran[]" class="hidden" id="uploadFile" multiple accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar">
          </label>

          <div id="filePreviewContainer" class="w-full flex justify-center mt-8">
            <div id="filePreview" class="flex flex-wrap justify-center items-center gap-6 w-full max-w-3xl transition-all duration-500"></div>
          </div>
        </div>

        <!-- Tombol Kirim -->
        <div class="pt-4">
          <button type="submit" name="kirim"
            class="w-full bg-gradient-to-r from-emerald-700 to-green-500 text-white text-lg font-semibold py-4 rounded-xl hover:from-emerald-800 hover:to-green-600 transition-all shadow-lg hover:shadow-emerald-400/40 flex justify-center items-center gap-3 active:scale-[0.98]">
            <i class="bi bi-send-fill text-white text-xl"></i> Kirim Laporan
          </button>
          <div id="progressContainer" class="w-full bg-white/20 h-2 rounded-full overflow-hidden mt-3 hidden">
            <div id="progressBar" class="h-full w-0 bg-gradient-to-r from-emerald-300 via-green-300 to-lime-300 animate-pulse"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- STYLE -->
<style>
  .form-icon, .form-icon-top {
    position: absolute; color: #34d399; font-size: 1.1rem;
    pointer-events: none; transition: all 0.3s ease;
  }
  .form-icon { left: 1rem; top: 50%; transform: translateY(-50%); }
  .form-icon-top { left: 1rem; top: 1rem; }
  .group:focus-within .form-icon, .group:focus-within .form-icon-top {
    color: #6fffa3; filter: drop-shadow(0 0 8px rgba(72,255,160,0.8));
    transform: scale(1.15);
  }
  .lapor-input { width: 100%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 0.75rem; padding: 0.9rem 1rem 0.9rem 2.8rem; font-size: 0.95rem;
    color: #f1fdf1; transition: all 0.3s ease;
  }
  .lapor-input::placeholder { color: rgba(220,255,220,0.55); }
  .lapor-input:focus { border-color: #22c55e; box-shadow: 0 0 10px rgba(34,197,94,0.4); transform: scale(1.02); }
  .lapor-textarea { padding: 1.8rem 1rem 1rem 2.8rem; line-height: 1.6rem; }
  select.kategori-select { appearance: none; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 0.75rem; padding: 0.9rem 1rem 0.9rem 2.8rem; font-size: 0.95rem;
    color: #e4ffe4; transition: all 0.3s ease; cursor: pointer;
  }
  select.kategori-select option { background: #0e1f17; color: #d1fae5; }
  .upload-btn { display: inline-flex; align-items: center; justify-content: center; gap: .6rem; padding: .9rem 1.5rem;
    font-weight: 600; border-radius: .75rem; cursor: pointer; transition: all .3s ease;
  }
  #filePreview div { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 15px; padding: 12px; color: #eaffea; text-align: center;
    width: 100%; max-width: 320px; box-shadow: 0 0 15px rgba(0,255,120,0.15);
    backdrop-filter: blur(10px); transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  #filePreview div:hover { transform: scale(1.06); box-shadow: 0 0 30px rgba(0,255,150,0.4); }
  #filePreview img, #filePreview video { width: 100%; height: auto; border-radius: 10px; object-fit: cover; }
  @keyframes auroraMove { 0%,100%{background-position:0% 50%;} 50%{background-position:100% 50%;} }
  .animate-aurora { animation: auroraMove 25s ease-in-out infinite; background-size: 200% 200%; }
  @keyframes twinkle { 0%,100%{opacity:0.1;transform:scale(1);} 50%{opacity:1;transform:scale(1.2);} }
  .star { position: absolute; border-radius: 50%; background: radial-gradient(circle,rgba(255,255,255,0.9)0%,rgba(255,255,255,0)70%);
    animation: twinkle 3s infinite ease-in-out;
  }
</style>

<!-- SCRIPT -->
<script>
  const kategoriSelect=document.getElementById("kategoriSelect");
  const kategoriIcon=document.getElementById("kategoriIcon");
  const iconMap={"Infrastruktur":{icon:"bi-tools",color:"#facc15"},"Lingkungan":{icon:"bi-tree-fill",color:"#22c55e"},
  "Keamanan":{icon:"bi-shield-lock",color:"#3b82f6"},"Sarana Publik":{icon:"bi-building",color:"#a855f7"},
  "Pendidikan":{icon:"bi-book",color:"#f97316"},"Kesehatan":{icon:"bi-heart-pulse-fill",color:"#ef4444"},
  "Ekonomi & Usaha":{icon:"bi-graph-up",color:"#10b981"},"Sosial":{icon:"bi-people-fill",color:"#ec4899"},
  "Lainnya":{icon:"bi-three-dots",color:"#9ca3af"}};
  kategoriSelect.addEventListener("change",()=>{const val=kategoriSelect.value;const opt=kategoriSelect.options[kategoriSelect.selectedIndex];
  const color=opt.getAttribute("data-color");kategoriSelect.style.color=color;kategoriSelect.style.textShadow=`0 0 6px ${color}`;
  if(iconMap[val]){kategoriIcon.className=`bi ${iconMap[val].icon} form-icon`;kategoriIcon.style.color=color;
  kategoriIcon.style.filter=`drop-shadow(0 0 6px ${color})`;}});

  const fileInput=document.getElementById("uploadFile");
  const filePreview=document.getElementById("filePreview");
  fileInput.addEventListener("change",()=>{filePreview.innerHTML='';Array.from(fileInput.files).forEach(file=>{
  const fileURL=URL.createObjectURL(file);const ext=file.name.split('.').pop().toLowerCase();const div=document.createElement('div');
  if(['jpg','jpeg','png','gif','webp'].includes(ext)){div.innerHTML=`<img src="${fileURL}" alt="${file.name}"><p>${file.name}</p>`;}
  else if(['mp4','mov','webm','mkv'].includes(ext)){div.innerHTML=`<video controls src="${fileURL}"></video><p>${file.name}</p>`;}
  else{div.innerHTML=`<i class="bi bi-file-earmark text-2xl text-gray-300"></i><p>${file.name}</p>`;}filePreview.appendChild(div);});});

  const form=document.getElementById("laporForm");
  const progressContainer=document.getElementById("progressContainer");
  const progressBar=document.getElementById("progressBar");
  form.addEventListener("submit",()=>{progressContainer.classList.remove("hidden");let progress=0;
  const interval=setInterval(()=>{progress+=2;progressBar.style.width=progress+"%";if(progress>=100)clearInterval(interval);},50);});

  const starfield=document.getElementById("starfield");
  for(let i=0;i<80;i++){const star=document.createElement("div");const size=Math.random()*3+1;star.classList.add("star");
  star.style.width=`${size}px`;star.style.height=`${size}px`;star.style.left=`${Math.random()*100}%`;
  star.style.top=`${Math.random()*100}%`;star.style.animationDuration=`${2+Math.random()*3}s`;starfield.appendChild(star);}
</script>

  <!-- FOOTER SEDERHANA (include) -->
  <?php include 'footer.php'; ?>

  <script>
    // Inisialisasi AOS bila dipakai
    if (typeof AOS !== 'undefined') AOS.init({ duration: 700, once: true });
  </script>
</body>
</html>

