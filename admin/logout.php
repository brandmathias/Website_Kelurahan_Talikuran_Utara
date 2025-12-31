<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Keluar...</title>
<!-- Masukkan di <head> pada semua halaman -->
<link rel="icon" href="logo.png" type="image/png" sizes="32x32">
<link rel="shortcut icon" href="logo.png" type="image/png">
<meta name="theme-color" content="#0b1f16">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
body {
  background: radial-gradient(circle at top, #0b1f16 0%, #03100b 100%);
  color: #a7f3d0;
  font-family: 'Poppins', sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  overflow: hidden;
}
.logout-box {
  text-align: center;
  animation: fadeUp 1s ease forwards;
}
.logout-box i {
  font-size: 4rem;
  color: #22c55e;
  animation: pulseGlow 1.5s infinite alternate;
}
@keyframes pulseGlow {
  from { text-shadow: 0 0 10px rgba(34,197,94,0.3); transform: scale(1); }
  to { text-shadow: 0 0 30px rgba(34,197,94,0.7); transform: scale(1.05); }
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>
<div class="logout-box">
  <i class="bi bi-check-circle-fill animate__animated animate__fadeInDown"></i>
  <h2 class="text-2xl mt-4 font-semibold animate__animated animate__fadeInUp">Anda telah berhasil keluar</h2>
  <p class="text-emerald-200 mt-2 mb-6 animate__animated animate__fadeInUp">Mengalihkan ke halaman login...</p>
  <div class="animate__animated animate__fadeIn">
    <div class="h-2 w-64 mx-auto bg-emerald-800/30 rounded-full overflow-hidden">
      <div id="bar" class="h-full w-0 bg-emerald-400 transition-all duration-[3000ms]"></div>
    </div>
  </div>
</div>

<script>
setTimeout(() => {
  document.getElementById("bar").style.width = "100%";
}, 300);

setTimeout(() => {
  Swal.fire({
    title: "Sampai Jumpa!",
    text: "Silakan login kembali untuk mengakses panel admin.",
    icon: "success",
    background: "rgba(15,36,28,0.9)",
    color: "#d1fae5",
    showConfirmButton: false,
    timer: 1600,
    timerProgressBar: true,
    willClose: () => window.location.href = "login.php"
  });
}, 2400);
</script>
</body>
</html>
