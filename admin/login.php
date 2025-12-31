<?php
session_start();
require_once __DIR__ . '/../config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  $res = $conn->query("SELECT * FROM admin WHERE username = '$username' LIMIT 1");

  if ($res && $res->num_rows > 0) {
    $user = $res->fetch_assoc();
    $hash = $user['password'];

    $ok = false;
    if (password_verify($password, $hash)) $ok = true;
    if (!$ok && md5($password) === $hash) $ok = true;
    if (!$ok && $password === $hash) $ok = true;

    if ($ok) {
      $_SESSION['admin'] = $user['username'];
      // Animasi login berhasil dengan transisi portal
      echo "
      <!DOCTYPE html>
      <html lang='id'>
      <head>
      <meta charset='UTF-8'>
      <title>Masuk ke Dashboard...</title>
      <script src='https://cdn.tailwindcss.com'></script>
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css'/>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'>

      <!-- ✅ Favicon dan Meta Theme Color -->
      <link rel='icon' href='logo.png' type='image/png' sizes='32x32'>
      <link rel='shortcut icon' href='logo.png' type='image/png'>
      <link rel='apple-touch-icon' sizes='180x180' href='logo.png'>
      <meta name='theme-color' content='#0b1f16'>

      <style>
        /* style kamu tetap di bawah sini */

          body {
            background: radial-gradient(circle at top, #03120a 0%, #0b1f16 100%);
            color: #a7f3d0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
          }
          .login-anim {
            text-align: center;
            animation: fadeInPortal 1s ease forwards;
          }
          @keyframes fadeInPortal {
            from { opacity: 0; transform: scale(0.8); filter: blur(10px); }
            to { opacity: 1; transform: scale(1); filter: blur(0); }
          }
          .login-anim i {
            font-size: 4rem;
            color: #10b981;
            animation: pulseIn 1.5s infinite alternate;
          }
          @keyframes pulseIn {
            from { text-shadow: 0 0 10px rgba(16,185,129,0.3); transform: scale(1); }
            to { text-shadow: 0 0 35px rgba(16,185,129,0.8); transform: scale(1.08); }
          }
        </style>
      </head>
      <body>
        <div class='login-anim'>
          <i class='bi bi-unlock-fill animate__animated animate__fadeInDown'></i>
          <h2 class='text-2xl mt-4 font-semibold animate__animated animate__fadeInUp'>Selamat Datang, " . htmlspecialchars($user['username']) . "!</h2>
          <p class='text-emerald-200 mt-2 mb-6 animate__animated animate__fadeInUp'>Mengalihkan ke dashboard...</p>
          <div class='animate__animated animate__fadeIn'>
            <div class='h-2 w-64 mx-auto bg-emerald-800/30 rounded-full overflow-hidden'>
              <div id='bar' class='h-full w-0 bg-emerald-400 transition-all duration-[3000ms]'></div>
            </div>
          </div>
        </div>
        <script>
          setTimeout(()=>{document.getElementById('bar').style.width='100%';},200);
          setTimeout(()=>{
            Swal.fire({
              title:'Login Berhasil!',
              text:'Selamat datang di panel admin.',
              icon:'success',
              background:'rgba(15,36,28,0.9)',
              color:'#d1fae5',
              showConfirmButton:false,
              timer:1500,
              timerProgressBar:true,
              willClose:()=>window.location.href='dashboard.php'
            });
          },2200);
        </script>
      </body>
      </html>";
      exit;
    }
  }

  // Jika gagal login
  echo "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script>
  Swal.fire({icon:'error',title:'Gagal Login',text:'Username atau password salah!',confirmButtonColor:'#b91c1c'});
  </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Login Admin — Talikuran Utara</title>
<link rel="icon" href="logo.png" type="image/png">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
  font-family:'Poppins',sans-serif;
  overflow:hidden;
  background:#0b1f16;
  color:#eaffea;
}
.scan-lines::before{
  content:'';position:absolute;inset:0;
  background:repeating-linear-gradient(
    to bottom,rgba(0,255,120,0.05)0,rgba(0,255,120,0.05)1px,transparent 2px,transparent 4px);
  animation:scanMove 10s linear infinite;
  z-index:0;pointer-events:none;
}
@keyframes scanMove{0%{background-position:0 0;}100%{background-position:0 100vh;}}
@keyframes auroraMove{0%,100%{background-position:0% 50%;}50%{background-position:100% 50%;}}
.animate-aurora{animation:auroraMove 30s ease-in-out infinite;background-size:200% 200%;}

/* Input & Button */
.form-icon{position:absolute;left:1rem;top:50%;transform:translateY(-50%);
  color:#34d399;font-size:1.2rem;transition:all .3s ease;pointer-events:none;}
.group:focus-within .form-icon{color:#6fffa3;filter:drop-shadow(0 0 8px rgba(72,255,160,.8));transform:scale(1.2);}
.lapor-input{width:100%;background:rgba(255,255,255,0.08);
  border:1px solid rgba(255,255,255,0.15);border-radius:.75rem;
  padding:.9rem 1rem .9rem 2.8rem;font-size:.95rem;color:#eaffea;transition:all .3s ease;}
.lapor-input::placeholder{color:rgba(220,255,220,0.5);}
.lapor-input:focus{border-color:#22c55e;box-shadow:0 0 10px rgba(34,197,94,0.4);transform:scale(1.02);}
.login-btn{position:relative;overflow:hidden;}
.login-btn span.loader{
  position:absolute;width:28px;height:28px;border:3px solid transparent;
  border-top-color:#a7f3d0;border-right-color:#a7f3d0;border-radius:50%;
  animation:spin 1s linear infinite;opacity:0;transition:opacity .3s;}
@keyframes spin{to{transform:rotate(360deg);}}
.login-btn.loading span.loader{opacity:1;}
.login-btn.loading .text{opacity:.3;}
.eye-btn{position:absolute;right:1rem;top:50%;transform:translateY(-50%);
  color:#9ae6b4;cursor:pointer;transition:all .3s ease;}
.eye-btn:hover{color:#6ee7b7;filter:drop-shadow(0 0 6px rgba(16,185,129,0.7));}
</style>
</head>

<body class="relative flex flex-col md:flex-row items-center justify-center min-h-screen scan-lines">

<!-- Left Panel -->
<div class="relative z-10 w-full md:w-1/2 flex flex-col items-center justify-center p-8">
  <div class="relative bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-[0_0_50px_rgba(0,255,140,0.15)] hover:shadow-[0_0_60px_rgba(0,255,160,0.25)] p-8 w-full max-w-md transition-all duration-700 animate__animated animate__fadeInUp">
    <div class="flex flex-col items-center mb-6">
      <img src="logo.png" class="w-16 h-16 mb-3 animate-pulse drop-shadow-[0_0_10px_rgba(0,255,150,0.4)]">
      <h1 class="text-2xl font-semibold tracking-wide drop-shadow-[0_0_8px_rgba(0,255,140,0.4)]">Login Admin</h1>
      <p class="text-emerald-100 text-sm">Kelurahan Talikuran Utara</p>
    </div>

    <form method="post" id="loginForm" class="space-y-5">
      <div class="relative group">
        <i class="bi bi-person-fill form-icon"></i>
        <input type="password" name="username" id="usernameField" required class="lapor-input" placeholder="Username Admin">
        <i class="bi bi-eye-slash-fill eye-btn" id="toggleUsername"></i>
      </div>

      <div class="relative group">
        <i class="bi bi-lock-fill form-icon"></i>
        <input type="password" name="password" id="passwordField" required class="lapor-input" placeholder="Password">
        <i class="bi bi-eye-slash-fill eye-btn" id="togglePassword"></i>
      </div>

      <button type="submit" id="loginBtn"
        class="login-btn w-full py-3 rounded-xl bg-gradient-to-r from-emerald-700 to-green-500 hover:from-emerald-800 hover:to-green-600 font-semibold text-lg shadow-lg hover:shadow-emerald-400/40 transition-all flex justify-center items-center gap-3 active:scale-[0.97]">
        <span class="loader"></span>
        <span class="text"><i class="bi bi-box-arrow-in-right text-white text-xl"></i> Login Sekarang</span>
      </button>
    </form>

    <p class="text-center text-emerald-200 text-xs mt-6">© 2025 Kelurahan Talikuran Utara</p>
  </div>
</div>

<!-- Right Panel -->
<div class="hidden md:flex w-1/2 h-full relative items-center justify-center">
  <div class="relative z-10 text-center px-8">
    <h2 class="text-4xl font-semibold text-emerald-200 mb-4 drop-shadow-[0_0_15px_rgba(0,255,140,0.4)]">Sistem Informasi Talikuran Utara</h2>
    <p class="text-emerald-100 max-w-md mx-auto leading-relaxed text-sm">
      Panel Administrasi Website Kelurahan Talikuran Utara.<br>Akses hanya untuk Admin resmi.
    </p>
  </div>
</div>

<script>
const form = document.getElementById('loginForm');
const btn = document.getElementById('loginBtn');
form.addEventListener('submit', () => { btn.classList.add('loading'); });

// Toggle password visibility
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');
togglePassword.addEventListener('click', () => {
  const isHidden = passwordField.type === 'password';
  passwordField.type = isHidden ? 'text' : 'password';
  togglePassword.classList.toggle('bi-eye-fill', isHidden);
  togglePassword.classList.toggle('bi-eye-slash-fill', !isHidden);
});

// Toggle username visibility
const toggleUsername = document.getElementById('toggleUsername');
const usernameField = document.getElementById('usernameField');
toggleUsername.addEventListener('click', () => {
  const isHidden = usernameField.type === 'password';
  usernameField.type = isHidden ? 'text' : 'password';
  toggleUsername.classList.toggle('bi-eye-fill', isHidden);
  toggleUsername.classList.toggle('bi-eye-slash-fill', !isHidden);
});
</script>

</body>
</html>
