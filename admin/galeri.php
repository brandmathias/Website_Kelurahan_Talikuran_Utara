<?php
include('header.php');
include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Galeri</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#03140d] min-h-screen font-[Poppins] text-emerald-50 p-6">

  <!-- Header -->
  <div class="flex items-center justify-between mb-8" data-aos="fade-down">
    <h2 class="text-3xl font-bold text-emerald-300 flex items-center gap-2 drop-shadow-[0_0_10px_rgba(16,185,129,0.6)]">
      <i class="bi bi-images text-emerald-400 animate-pulse"></i> Kelola Galeri
    </h2>
    <a href="tambah_galeri.php"
       class="bg-gradient-to-r from-emerald-600 to-green-500 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 hover:from-emerald-700 hover:to-green-600 hover:scale-105 active:scale-95 shadow-[0_0_15px_rgba(0,255,150,0.3)] transition-all duration-300">
       <i class="bi bi-plus-lg"></i> Tambah Gambar
    </a>
  </div>

  <!-- Container Galeri -->
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" data-aos="fade-up">
    <?php
    $sql = "SELECT id, judul, foto FROM galeri ORDER BY id DESC";
    $q   = $conn->query($sql);
    if ($q && $q->num_rows):
      while ($r = $q->fetch_assoc()):
        $img = (!empty($r['foto']) && file_exists(__DIR__ . '/../' . $r['foto']))
                ? '../'.$r['foto']
                : 'https://via.placeholder.com/600x400?text=Foto';
    ?>
    <div class="rounded-2xl bg-[#072015] border border-emerald-800/50 shadow-[0_0_30px_rgba(0,255,150,0.08)] overflow-hidden hover:shadow-[0_0_40px_rgba(0,255,150,0.18)] transition-all duration-500 relative group" id="card-<?= $r['id'] ?>">
      <img src="<?= $img ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500" alt="galeri">
      <div class="p-4 border-t border-emerald-900/50">
        <h3 class="font-semibold text-emerald-200 text-base tracking-wide"><?= htmlspecialchars($r['judul']) ?></h3>
        <div class="flex justify-center gap-2 mt-3">
          <!-- Preview -->
          <button onclick="previewGaleri('<?= htmlspecialchars($r['judul']) ?>','<?= $img ?>')"
                  class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-emerald-600/80 hover:bg-emerald-500 text-white text-sm shadow hover:shadow-emerald-400/30 transition duration-300">
            <i class="bi bi-eye-fill"></i> Review
          </button>

          <!-- Edit -->
          <a href="edit_galeri.php?id=<?= $r['id'] ?>"
             class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-blue-600/80 hover:bg-blue-500 text-white text-sm shadow hover:shadow-blue-400/30 transition duration-300">
            <i class="bi bi-pencil-square"></i> Edit
          </a>

          <!-- Hapus -->
          <button onclick="hapusGaleri(<?= $r['id'] ?>)"
                  class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-red-600/80 hover:bg-red-500 text-white text-sm shadow hover:shadow-red-400/30 transition duration-300">
            <i class="bi bi-trash3"></i> Hapus
          </button>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
      <p class="text-gray-400 italic text-center col-span-full">Belum ada data galeri.</p>
    <?php endif; ?>
  </div>

  <!-- SCRIPT: Hapus Galeri -->
  <script>
  function hapusGaleri(id) {
    Swal.fire({
      title: 'Hapus Gambar?',
      text: 'Data ini akan dihapus secara permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: '<i class="bi bi-trash"></i> Ya, hapus',
      cancelButtonText: 'Batal',
      background: '#092016',
      color: '#d1fae5',
      reverseButtons: true,
      showClass: { popup: 'animate__animated animate__fadeInDown' },
      hideClass: { popup: 'animate__animated animate__fadeOutUp' }
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('hapus_galeri.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + id
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Terhapus!',
              text: data.message,
              showConfirmButton: false,
              timer: 1200,
              background: '#092016',
              color: '#d1fae5'
            });
            const card = document.getElementById('card-' + id);
            if (card) {
              card.style.transition = 'all 0.6s ease';
              card.style.opacity = '0';
              card.style.transform = 'scale(0.95)';
              setTimeout(() => card.remove(), 600);
            }
          } else {
            Swal.fire('Gagal!', data.message, 'error');
          }
        })
        .catch(() => Swal.fire('Error!', 'Tidak dapat menghapus data.', 'error'));
      }
    });
  }

  // SCRIPT: Preview Galeri
  function previewGaleri(judul, foto) {
    Swal.fire({
      title: `<h3 style='color:#6ee7b7;'>${judul}</h3>`,
      html: `
        <img src='${foto}' style='width:100%;max-height:400px;object-fit:cover;border-radius:12px;margin-bottom:10px;box-shadow:0_0_20px_rgba(16,185,129,0.5);'>
      `,
      background: '#062015',
      color: '#a7f3d0',
      showCloseButton: true,
      showConfirmButton: false,
      width: 600,
      backdrop: `rgba(0,0,0,0.7)`
    });
  }

  AOS.init({ duration: 800, once: true });
  </script>

</body>
</html>
<?php include('footer.php'); ?>
