<?php
session_start();

// Handle cancel
if (isset($_GET['cancel'])) {
    unset($_SESSION['verified_user']);
    header('Location: forgot_password.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
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
            <i class="bi bi-key"></i>
            <h2>Lupa Password</h2>
            <p>Masukkan email atau username Anda untuk reset password</p>
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

        <?php
        // Generate captcha math question
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operator = rand(0, 1) ? '+' : '-';
        if ($operator == '-' && $num1 < $num2) {
            $temp = $num1;
            $num1 = $num2;
            $num2 = $temp;
        }
        $question = "Berapa $num1 $operator $num2?";
        $answer = $operator == '+' ? $num1 + $num2 : $num1 - $num2;
        $_SESSION['captcha_question'] = $question;
        $_SESSION['captcha_answer'] = $answer;
        ?>

        <?php if (!isset($_SESSION['verified_user'])): ?>
            <!-- Step 1: Verifikasi Email/Username -->
            <form method="POST" action="backend/query/proses_reset_password.php">
                <div class="mb-3">
                    <label for="identifier" class="form-label">Email atau Username</label>
                    <input type="text" class="form-control" id="identifier" name="identifier" required>
                </div>

                <div class="mb-3">
                    <label for="captcha" class="form-label">Captcha: <?php echo $question; ?></label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="step" value="verify" class="btn btn-custom">
                        <i class="bi bi-search"></i> Cari Akun
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        <?php else: ?>
            <!-- Step 2: Set Password Baru -->
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Akun ditemukan: <strong><?php echo htmlspecialchars($_SESSION['verified_user']['email'] ?? $_SESSION['verified_user']['username']); ?></strong>
            </div>
            <form method="POST" action="backend/query/proses_reset_password.php">
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
                    <div class="form-text">Minimal 6 karakter</div>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="step" value="reset" class="btn btn-custom">
                        <i class="bi bi-send"></i> Reset Password
                    </button>
                    <a href="?cancel=1" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Validasi konfirmasi password di frontend
        document.getElementById('confirm_password').addEventListener('input', function() {
            const passwordBaru = document.getElementById('new_password').value;
            const konfirmasi = this.value;

            if (passwordBaru !== konfirmasi) {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
