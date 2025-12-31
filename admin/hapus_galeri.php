<?php
include_once('../config/config.php');
header('Content-Type: application/json');

$id = intval($_POST['id'] ?? 0);
$response = ['status' => 'error', 'message' => 'Gagal menghapus data.'];

if ($id > 0) {
  $stmt = $conn->prepare("SELECT foto FROM galeri WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $path = __DIR__ . '/../' . $row['foto'];
    if (!empty($row['foto']) && file_exists($path)) {
      unlink($path);
    }
  }

  $delete = $conn->prepare("DELETE FROM galeri WHERE id = ?");
  $delete->bind_param("i", $id);
  if ($delete->execute()) {
    $response = ['status' => 'success', 'message' => 'Gambar berhasil dihapus.'];
  }
}

echo json_encode($response);
?>
