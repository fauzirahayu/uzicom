<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Jamaah Haji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <style>

  </style>
</head>

<body>
  <div class="container-fluid login-container">
    <div class="row h-100">
      
      <!-- Left side form -->
      <div class="col-md-6 login-left">
        <h2 class="text-center mb-4">SELAMAT DATANG</h2>
        <p class="text-center text-muted">Selamat datang kembali! Silakan masukkan detail Anda.</p>

        <form action="backend/query/proses_login.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <input type="checkbox" id="remember">
              <label for="remember">Ingat aku</label>
            </div>
            <a href="forgot_password.php" class="text-decoration-none">Lupa Password?</a>
          </div>

          <button type="submit" class="btn btn-custom w-100 mb-3" name="login">Log in</button>
          <p class="text-center mt-3">
           Belum punya akun? <a href="pengguna/daftar.php"> Daftar gratis!</a>
          </p>
        </form>
      </div>

      <!-- Right side image -->
      <div class="col-md-6 login-right d-none d-md-block"></div>

    </div>
  </div>
</body>

</html>
