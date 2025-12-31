<?php
include_once(__DIR__ . '/../config/config.php');
ob_start(); // pastikan tidak ada output sisa

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Berita</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel='icon' href='logo.png' type='image/png' sizes='32x32'>
  <style>
    body {
      background: #001b12;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
  </style>
</head>
<body>
<?php

if (!isset($_GET['id'])) {
  echo "
  <script>
  Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: 'ID berita tidak ditemukan.',
    background: 'rgba(15,36,28,0.95)',
    color: '#d1fae5',
    confirmButtonColor: '#10b981',
    showClass: { popup: 'animate__animated animate__fadeInDown' },
    hideClass: { popup: 'animate__animated animate__fadeOutUp' }
  }).then(() => window.location='berita.php');
  </script>";
  exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT foto FROM berita WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
  if (!empty($row['foto'])) {
    $filePath = __DIR__ . '/../' . $row['foto'];
    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }

  $delete = $conn->prepare("DELETE FROM berita WHERE id = ?");
  $delete->bind_param("i", $id);
  $delete->execute();

  echo "
  <script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Berita berhasil dihapus.',
    timer: 1300,
    showConfirmButton: false,
    background: 'rgba(15,36,28,0.95)',
    color: '#d1fae5',
    showClass: { popup: 'animate__animated animate__fadeInUp' },
    hideClass: { popup: 'animate__animated animate__fadeOutDown' },
    backdrop: 'rgba(0,0,0,0.7)'
  }).then(() => window.location='berita.php');
  </script>";
} else {
  echo "
  <script>
  Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: 'Data berita tidak ditemukan.',
    background: 'rgba(15,36,28,0.95)',
    color: '#d1fae5',
    confirmButtonColor: '#10b981',
    showClass: { popup: 'animate__animated animate__fadeInDown' },
    hideClass: { popup: 'animate__animated animate__fadeOutUp' }
  }).then(() => window.location='berita.php');
  </script>";
}

?>
</body>
</html>
<?php
ob_end_flush();
?>
