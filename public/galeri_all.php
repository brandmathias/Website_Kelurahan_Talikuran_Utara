<?php include_once __DIR__ . '/../config/config.php'; ?> 
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Semua Galeri — Kelurahan Talikuran Utara</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>

  <link rel="icon" type="image/png" href="assets/logo.png">
  <meta name="theme-color" content="#14532d">

  <style>
    :root{
      --brand:#14532d;
      --bg:#f7faf7;
    }
    body{ font-family:'Poppins',sans-serif; background:var(--bg); color:#0f172a; overflow-x:hidden; }
    .hero-title{ letter-spacing:.2px; }

    /* ✅ Efek underline navbar sama seperti di index.php */
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

    /* Style galeri (tetap utuh) */
    .gcard{
      border-radius:18px; overflow:hidden; background:#0b0b0b;
      box-shadow:0 12px 30px rgba(20,83,45,.12);
      transform-style:preserve-3d;
      transition: transform 0.5s ease, box-shadow 0.5s ease;
    }
    .gimg{ width:100%; height:100%; object-fit:cover; transition:transform 1s ease, filter .4s ease; }
    .gcard:hover .gimg{ transform:scale(1.06); filter:contrast(105%) brightness(1.1); }
    .gcard:hover { transform: translateY(-6px) scale(1.02); box-shadow:0 18px 35px rgba(20,83,45,.25); }
    .gmask::after{
      content:""; position:absolute; inset:0; 
      background:linear-gradient(to top, rgba(0,0,0,.5), transparent 55%);
      pointer-events:none;
    }
    .glabel{
      position:absolute; left:14px; bottom:12px; right:14px; z-index:2;
      color:#fff; text-shadow:0 2px 8px rgba(0,0,0,.6);
    }
    .gtitle{ font-weight:600; font-size:1.05rem; line-height:1.2; }
    .gmeta { font-size:.8rem; opacity:.9 }
    .grid-auto{
      display:grid;
      grid-template-columns:repeat(1, minmax(0,1fr));
      gap:18px;
      grid-auto-rows:10px;
    }
    @media (min-width:640px){ .grid-auto{ grid-template-columns:repeat(2, minmax(0,1fr)); } }
    @media (min-width:1024px){ .grid-auto{ grid-template-columns:repeat(3, minmax(0,1fr)); } }
    @media (min-width:1280px){ .grid-auto{ grid-template-columns:repeat(4, minmax(0,1fr)); } }
    .lb-backdrop{ backdrop-filter:blur(6px); }
    .float-dot{ position:absolute; width:8px; height:8px; border-radius:9999px; background:rgba(20,83,45,.15); filter:blur(1px);}
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

<script>
  // Efek blur header saat scroll
  const navbar = document.getElementById("navbar");
  window.addEventListener("scroll", () => {
    navbar.classList.toggle("bg-white/80", window.scrollY > 50);
    navbar.classList.toggle("backdrop-blur-md", window.scrollY > 50);
    navbar.classList.toggle("shadow-md", window.scrollY > 50);
  });
</script>

<!-- 🔻 Seluruh bagian di bawah ini tidak diubah sama sekali -->
<!-- Floating dots -->
<div class="pointer-events-none absolute inset-0 -z-10">
  <span class="float-dot" style="top:140px; left:8%;"></span>
  <span class="float-dot" style="top:460px; left:16%;"></span>
  <span class="float-dot" style="top:220px; right:12%;"></span>
  <span class="float-dot" style="top:720px; right:20%;"></span>
</div>

<!-- Hero -->
<section class="pt-32 pb-10">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex items-center gap-3 mb-3">
      <i class="bi bi-images text-2xl text-[var(--brand)]"></i>
      <p class="text-sm text-gray-600">Semua dokumentasi visual Kelurahan</p>
    </div>
    <h2 class="hero-title text-3xl md:text-5xl font-merriweather font-bold text-green-900">
      Galeri Kelurahan <span class="text-[var(--brand)]">Talikuran Utara</span>
    </h2>

    <div class="mt-6 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
      <div class="relative w-full md:w-80">
        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
        <input id="searchBox" type="text" placeholder="Cari judul gambar…" class="w-full pl-9 pr-3 py-2 rounded-lg border border-green-200 focus:outline-none focus:ring-2 focus:ring-green-600/40 focus:border-green-600/50 bg-white"/>
      </div>
    </div>
  </div>
</section>

<!-- Grid -->
<section class="pb-20">
  <div id="gridWrap" class="max-w-7xl mx-auto px-6">
    <div id="galeriGrid" class="grid-auto">
      <?php
        $rows = [];
        $q = $conn->query("SELECT * FROM galeri ORDER BY id DESC");
        while($r = $q->fetch_assoc()){
          $path = $r['foto'] ?? '';
          $img  = (!empty($path) && file_exists(__DIR__ . '/../' . $path)) ? '../' . ltrim($path,'/') : 'https://via.placeholder.com/1200x800?text=Galeri+Kelurahan';
          $judul = htmlspecialchars($r['judul'] ?? 'Tanpa Judul');
          $tgl = $r['tanggal'] ?? '';
          $tglText = $tgl ? date('d M Y', strtotime($tgl)) : '';
          $h = rand(18,28);
          echo "
            <article class='gitem group relative gcard gmask' 
                     data-title='$judul' data-date='$tgl' 
                     style='grid-row: span {$h};'>
              <img loading='lazy' src='$img' alt='$judul' class='gimg w-full h-full'>
              <div class='glabel'>
                <div class='gtitle'>$judul</div>
                ".($tglText ? "<div class='gmeta flex items-center gap-1'><i class=\"bi bi-calendar-week\"></i> $tglText</div>" : "")."
              </div>
              <button class='absolute top-3 right-3 bg-white/90 hover:bg-white text-[var(--brand)] shadow px-3 py-1 rounded-full text-xs font-semibold transition'>
                <i class='bi bi-arrows-fullscreen'></i>
              </button>
            </article>
          ";
        }
      ?>
    </div>

    <div id="emptyState" class="hidden text-center py-20 text-gray-500">
      <i class="bi bi-image-alt text-4xl mb-3"></i>
      <p>Tidak ada galeri yang cocok dengan pencarian.</p>
    </div>
  </div>
</section>

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 hidden items-center justify-center z-[60]">
  <div class="absolute inset-0 bg-black/70 lb-backdrop"></div>
  <div class="relative bg-white rounded-2xl shadow-2xl w-[94vw] max-w-6xl overflow-hidden">
    <button id="lbClose" class="absolute top-3 right-3 bg-white/90 hover:bg-white text-gray-700 rounded-full px-3 py-1 shadow transition">
      <i class="bi bi-x-lg"></i>
    </button>
    <div class="w-full h-[65vh] md:h-[80vh] overflow-hidden bg-black flex items-center justify-center">
      <img id="lbImg" src="" alt="" class="w-full h-full object-contain transition-transform duration-500 ease-in-out scale-100">
    </div>
    <div class="p-5">
      <h3 id="lbTitle" class="text-xl font-semibold text-green-800"></h3>
      <p id="lbMeta" class="text-sm text-gray-500 mt-1"></p>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
gsap.registerPlugin(ScrollTrigger, Flip);
// Semua animasi asli tetap utuh
const nb=document.getElementById('navbar');
window.addEventListener('scroll',()=>{ nb.style.boxShadow=window.scrollY>16?'0 8px 20px rgba(16,185,129,.10)':'none'; });
gsap.from(".gitem",{opacity:0,y:60,rotateX:-8,duration:.9,ease:"power3.out",stagger:{each:.06,from:"random"},scrollTrigger:{trigger:"#galeriGrid",start:"top 85%"}});
document.querySelectorAll(".gitem").forEach(card=>{
  let enter=()=>gsap.to(card,{duration:.6,rotateX:-4,rotateY:4,y:-4,ease:"power3.out"});
  let leave=()=>gsap.to(card,{duration:.8,rotateX:0,rotateY:0,y:0,ease:"power3.out"});
  card.addEventListener("mouseenter",enter);
  card.addEventListener("mouseleave",leave);
});
const searchBox=document.getElementById('searchBox');
const items=[...document.querySelectorAll('.gitem')];
function applyFilter(){
  const q=(searchBox.value||"").toLowerCase();
  let visible=0;
  items.forEach(it=>{
    const ok=it.dataset.title.toLowerCase().includes(q);
    it.classList.toggle('hidden',!ok);
    if(ok)visible++;
  });
  document.getElementById('emptyState').classList.toggle('hidden',visible!==0);
}
searchBox.addEventListener('input',applyFilter);
const lb=document.getElementById('lightbox');
const lbImg=document.getElementById('lbImg');
const lbTitle=document.getElementById('lbTitle');
const lbMeta=document.getElementById('lbMeta');
const lbClose=document.getElementById('lbClose');
function openLB(src,title,meta){
  lbImg.src=src;lbTitle.textContent=title;lbMeta.textContent=meta||'';
  lb.classList.remove('hidden');
  gsap.fromTo(lb.querySelector('.bg-white'),{y:60,opacity:0,scale:.98},{y:0,opacity:1,scale:1,duration:.5,ease:'power3.out'});
}
function closeLB(){
  gsap.to(lb.querySelector('.bg-white'),{y:-40,opacity:0,duration:.35,ease:'power2.in',onComplete:()=>{lb.classList.add('hidden');}});
}
lbClose.addEventListener('click',closeLB);
lb.addEventListener('click',e=>{if(e.target===lb||e.target.classList.contains('lb-backdrop'))closeLB();});
document.querySelectorAll('.gitem').forEach(card=>{
  const btn=card.querySelector('button');
  const img=card.querySelector('img');
  const title=card.dataset.title||'Galeri';
  const date=card.dataset.date?new Date(card.dataset.date).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'}):'';
  const meta=date?`Diunggah: ${date}`:'';
  const open=()=>openLB(img.src,title,meta);
  btn.addEventListener('click',open);
  img.addEventListener('click',open);
});
gsap.utils.toArray('.float-dot').forEach((d,i)=>{
  gsap.to(d,{y:gsap.utils.random(-20,30),x:gsap.utils.random(-20,20),duration:gsap.utils.random(4,8),yoyo:true,repeat:-1,ease:'sine.inOut',delay:i*.2});
});
</script>
</body>
</html>
