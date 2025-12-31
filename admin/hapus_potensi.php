<?php
include_once('../config/config.php');
header('Content-Type: application/json');

$id = intval($_POST['id'] ?? 0);
$response = ['status' => 'error', 'message' => 'Gagal menghapus data.'];

if ($id > 0) {
  $q = $conn->query("SELECT foto FROM potensi WHERE id=$id");
  if ($q && $r = $q->fetch_assoc()) {
    if (!empty($r['foto']) && file_exists(__DIR__ . '/../' . $r['foto'])) {
      unlink(__DIR__ . '/../' . $r['foto']);
    }
  }

  $delete = $conn->query("DELETE FROM potensi WHERE id=$id");
  if ($delete) {
    $response = ['status' => 'success', 'message' => 'Potensi berhasil dihapus.'];
  }
}

echo json_encode($response);
?>