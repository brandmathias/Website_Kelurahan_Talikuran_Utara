<?php
include 'header.php';
include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Potensi Desa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="logo.png">
  <meta name="theme-color" content="#14532d">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#03140d] min-h-screen p-6 font-[Poppins] text-emerald-50">

  <!-- Header -->
  <div class="flex items-center justify-between mb-8" data-aos="fade-down">
    <h2 class="text-3xl font-bold text-emerald-300 flex items-center gap-2 drop-shadow-[0_0_12px_rgba(16,185,129,0.6)]">
      <i class="bi bi-gem text-emerald-400 animate-pulse"></i> Kelola Potensi Desa
    </h2>
    <a href="tambah_potensi.php"
       class="bg-gradient-to-r from-emerald-600 to-green-500 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 hover:from-emerald-700 hover:to-green-600 hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(0,255,150,0.3)] transition-all duration-300">
       <i class="bi bi-plus-lg"></i> Tambah Potensi
    </a>
  </div>

  <!-- Table Container -->
  <div class="bg-[#072015] rounded-2xl border border-emerald-800/40 shadow-[0_0_40px_rgba(0,255,150,0.08)] overflow-x-auto" data-aos="fade-up">
    <table class="min-w-full text-sm">
      <thead class="bg-emerald-700/90 text-emerald-50 uppercase tracking-wide text-xs">
        <tr>
          <th class="py-3 px-4 text-left">Judul</th>
          <th class="py-3 px-4 text-left">Isi</th>
          <th class="py-3 px-4 text-center">Foto</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-emerald-800/40">
        <?php
        $res = $conn->query("SELECT * FROM potensi ORDER BY id DESC");
        if ($res && $res->num_rows):
          while ($row = $res->fetch_assoc()):
            $thumb = (!empty($row['foto']) && file_exists(__DIR__ . '/../' . $row['foto']))
              ? '../' . $row['foto']
              : 'https://via.placeholder.com/120x80?text=No+Image';
        ?>
        <tr class="hover:bg-emerald-900/30 transition duration-300" id="row-<?php echo $row['id']; ?>">
          <td class="py-3 px-4 font-semibold text-emerald-200"><?php echo htmlspecialchars($row['judul']); ?></td>
          <td class="py-3 px-4 text-emerald-300/90 truncate max-w-xs"><?php echo htmlspecialchars(substr($row['deskripsi'],0,80)); ?>...</td>
          <td class="py-3 px-4 text-center">
            <img src="<?php echo $thumb; ?>" class="w-24 h-16 object-cover rounded-lg border border-emerald-700/50 shadow-[0_0_10px_rgba(16,185,129,0.3)] hover:scale-105 transition duration-300">
          </td>
          <td class="py-3 px-4 text-center flex flex-wrap justify-center gap-2">
            <!-- Review -->
            <button 
              class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-emerald-600/80 hover:bg-emerald-500 text-white text-sm shadow-md hover:shadow-emerald-400/30 transition duration-300 btn-preview"
              data-judul="<?= htmlspecialchars($row['judul']); ?>"
              data-deskripsi="<?= htmlspecialchars($row['deskripsi']); ?>"
              data-foto="<?= $thumb; ?>">
              <i class="bi bi-eye-fill"></i> Review
            </button>
            <!-- Edit -->
            <a href="edit_potensi.php?id=<?php echo $row['id']; ?>"
               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-blue-600/80 hover:bg-blue-500 text-white text-sm shadow-md hover:shadow-blue-400/30 transition duration-300">
               <i class="bi bi-pencil-square"></i> Edit
            </a>
            <!-- Hapus -->
            <button onclick="hapusPotensi(<?php echo $row['id']; ?>)"
                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-red-600/80 hover:bg-red-500 text-white text-sm shadow-md hover:shadow-red-400/30 transition duration-300">
              <i class="bi bi-trash3"></i> Hapus
            </button>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="4" class="text-center text-emerald-400 py-6 italic">Belum ada data potensi.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- SCRIPT: Hapus Potensi -->
  <script>
  function hapusPotensi(id) {
    Swal.fire({
      title: 'Hapus Potensi?',
      text: 'Data ini akan dihapus secara permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#6b7280',
      confirmButtonText: '<i class="bi bi-trash"></i> Ya, hapus',
      cancelButtonText: 'Batal',
      background: '#062015',
      color: '#d1fae5',
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('hapus_potensi.php', {
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
            const row = document.getElementById('row-' + id);
            if (row) {
              row.style.transition = 'all 0.6s ease';
              row.style.opacity = '0';
              row.style.transform = 'translateX(-20px) scale(0.97)';
              setTimeout(() => row.remove(), 600);
            }
          } else {
            Swal.fire('Gagal!', data.message, 'error');
          }
        })
        .catch(() => Swal.fire('Error!', 'Tidak dapat menghapus data.', 'error'));
      }
    });
  }

  // SCRIPT: Preview Potensi
  document.querySelectorAll('.btn-preview').forEach(btn => {
    btn.addEventListener('click', () => {
      const judul = btn.dataset.judul;
      const deskripsi = btn.dataset.deskripsi.replace(/\n/g, '<br>');
      const foto = btn.dataset.foto;
      Swal.fire({
        title: `<h3 style='color:#6ee7b7;'>${judul}</h3>`,
        html: `
          <img src='${foto}' style='width:100%;max-height:250px;object-fit:cover;border-radius:12px;margin-bottom:10px;box-shadow:0_0_20px_rgba(16,185,129,0.5);'>
          <div style='color:#a7f3d0;text-align:justify;font-size:14px;'>${deskripsi}</div>
        `,
        background: '#062015',
        color: '#d1fae5',
        showCloseButton: true,
        showConfirmButton: false,
        width: 600,
        backdrop: `rgba(0,0,0,0.7)`
      });
    });
  });

  AOS.init({ duration: 800, once: true });
  </script>

</body>
</html>
<?php include 'footer.php'; ?>
