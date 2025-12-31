<?php
include_once('../config/config.php');
$id = $_GET['id'];

if ($conn->query("DELETE FROM kontak WHERE id='$id'")) {
  echo "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script>
  Swal.fire({
    title: 'Dihapus!',
    text: 'Pesan berhasil dihapus.',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
  }).then(() => {
    window.location = 'kontak.php';
  });
  </script>";
} else {
  echo "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script>
  Swal.fire({
    title: 'Gagal!',
    text: 'Terjadi kesalahan saat menghapus.',
    icon: 'error',
    confirmButtonColor: '#b91c1c'
  }).then(() => {
    window.location = 'kontak.php';
  });
  </script>";
}
?>
