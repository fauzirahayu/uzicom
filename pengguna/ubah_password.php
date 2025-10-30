<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}
include __DIR__ . '/../backend/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../contern/css/jamaah.css" />
    <style>
        body {
            background: url('https://images.pexels.com/photos/2291789/pexels-photo-2291789.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            color: #226d3d;
        }

        .conten {
            margin: 40px auto;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(34, 109, 61, 0.1);
            padding: 40px;
        }

        .profil-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profil-header i {
            font-size: 3rem;
            color: #388e3c;
        }

        .btn-custom {
            background-color: #388e3c;
            border-color: #388e3c;
            color: white;
        }

        .btn-custom:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="conten">
        <div class="profil-header">
            <i class="bi bi-shield-lock"></i>
            <h2>Ubah Password</h2>
            <p>Perbarui password akun Anda</p>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                <ul class="mb-0">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <form method="POST" action="../backend/query/update_password.php">
            <div class="mb-3">
                <label for="password_lama" class="form-label">Password Lama</label>
                <input type="password" class="form-control" id="password_lama" name="password_lama" required>
            </div>

            <div class="mb-3">
                <label for="password_baru" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                <div class="form-text">Minimal 6 karakter</div>
            </div>

            <div class="mb-3">
                <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">
                    <i class="bi bi-check-lg"></i> Ubah Password
                </button>
                <a href="profil.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Profil
                </a>
            </div>
        </form>
    </div>

    <script>
        // Validasi konfirmasi password di frontend
        document.getElementById('konfirmasi_password').addEventListener('input', function() {
            const passwordBaru = document.getElementById('password_baru').value;
            const konfirmasi = this.value;

            if (passwordBaru !== konfirmasi) {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>

</html>
