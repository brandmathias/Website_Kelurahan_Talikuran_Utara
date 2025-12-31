<?php
include_once(__DIR__ . '/../config/config.php');
header('Content-Type: application/json');

$id = intval($_POST['id'] ?? 0);
$response = ['status' => 'error', 'message' => 'Tidak dapat menghapus data.'];

if ($id > 0) {
  // Cek apakah data ada
  $stmt = $conn->prepare("SELECT foto FROM struktur_pemerintahan WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    // Hapus file foto jika ada
    if (!empty($row['foto'])) {
      $filePath = __DIR__ . '/../' . $row['foto'];
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }
  }
  $stmt->close();

  // Hapus dari database
  $del = $conn->prepare("DELETE FROM struktur_pemerintahan WHERE id=?");
  $del->bind_param("i", $id);
  if ($del->execute()) {
    $response = ['status' => 'success', 'message' => 'Data struktur berhasil dihapus.'];
  } else {
    $response = ['status' => 'error', 'message' => 'Gagal menghapus data dari database.'];
  }
  $del->close();
}

echo json_encode($response);
?>
