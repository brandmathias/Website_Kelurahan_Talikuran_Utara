<?php
header('Content-Type: application/json');
include_once('../config/config.php');

$id = (int)($_POST['id'] ?? 0);
$status = $_POST['status'] ?? '';

$allowed = ['baru','diproses','selesai'];
if(!$id || !in_array($status, $allowed)){
  echo json_encode(['ok'=>false,'msg'=>'Parameter tidak valid']); exit;
}

$stmt = $conn->prepare("UPDATE laporan SET status=? WHERE id=?");
$stmt->bind_param('si', $status, $id);
if($stmt->execute()){
  echo json_encode(['ok'=>true,'msg'=>'Status berhasil diperbarui']);
}else{
  echo json_encode(['ok'=>false,'msg'=>$conn->error]);
}
?>
