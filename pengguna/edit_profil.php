<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}
include __DIR__ . '/../backend/query/read.php';

// Ambil data pengguna berdasarkan session id
$user_id = $_SESSION['id'];
$sql_user = "SELECT * FROM pengguna WHERE id = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user = $stmt->get_result();
$user = $result_user->fetch_assoc();
$stmt->close();

if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil</title>
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
            <i class="bi bi-pencil-square"></i>
            <h2>Edit Profil</h2>
            <p>Perbarui informasi pribadi Anda</p>
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

        <form method="POST" action="../backend/query/update_profil.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control" id="nik" name="nik" value="<?php echo htmlspecialchars($user['nik'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">
                    <i class="bi bi-check-lg"></i> Simpan Perubahan
                </button>
                <a href="profil.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Profil
                </a>
            </div>
        </form>
    </div>
</body>

</html>
