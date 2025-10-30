<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Jamaah Haji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../index.css">
</head>

<body>
  <div class="container-fluid login-container">
    <div class="row h-100">

      <!-- Left side form -->
      <div class="col-md-6 login-left">
        <h2 class="text-center mb-4">DAFTAR AKUN BARU</h2>
        <p class="text-center text-muted">Silakan isi detail Anda untuk mendaftar.</p>

        <form action="../backend/query/proses_daftar_pengguna.php" method="POST" id="registerForm">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required minlength="2" maxlength="100">
            <div class="invalid-feedback">Nama harus diisi (2-100 karakter).</div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email Anda" required>
            <div class="invalid-feedback">Masukkan email yang valid.</div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required minlength="6">
            <div class="invalid-feedback">Password minimal 6 karakter.</div>
          </div>

          <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi kata sandi" required>
            <div class="invalid-feedback">Konfirmasi password tidak cocok.</div>
          </div>

          <button type="submit" class="btn btn-custom w-100 mb-3" id="submitBtn">
            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            Daftar
          </button>
          <p class="text-center mt-3">
           Sudah punya akun? <a href="../index.php">Login</a>
          </p>
        </form>
      </div>

      <!-- Right side image -->
      <div class="col-md-6 login-right d-none d-md-block"></div>

    </div>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (password !== confirmPassword) {
        e.preventDefault();
        document.getElementById('confirm_password').classList.add('is-invalid');
        return false;
      }

      // Show loading spinner
      document.getElementById('submitBtn').disabled = true;
      document.querySelector('.spinner-border').classList.remove('d-none');
    });

    // Real-time validation
    document.getElementById('confirm_password').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;

      if (password === confirmPassword) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
      } else {
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
      }
    });
  </script>
</body>

</html>
