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
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Saya</title>
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
            max-width: 800px;
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

        .profil-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(34, 109, 61, 0.10);
            border: 1px solid #e0e7c7;
            padding: 20px;
        }

        .profil-item {
            margin-bottom: 15px;
        }

        .profil-item strong {
            color: #2e7d32;
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
    </style>
</head>

<body>
    <div class="conten">
        <div class="profil-header">
            <i class="bi bi-person-circle"></i>
            <h2>Profil Saya</h2>
            <p>Kelola informasi pribadi Anda</p>
        </div>

        <div class="profil-card">
            <div class="profil-item">
                <strong>Username:</strong> <?php echo htmlspecialchars($user['username'] ?? ''); ?>
            </div>
            <div class="profil-item">
                <strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?>
            </div>
            <div class="profil-item">
                <strong>NIK:</strong> <?php echo htmlspecialchars($user['nik'] ?? ''); ?>
            </div>
            <div class="profil-item">
                <strong>Password:</strong> ******** (Untuk keamanan, password tidak ditampilkan)
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="edit_profil.php" class="btn btn-primary me-2"><i class="bi bi-pencil"></i> Edit Profil</a>
            <a href="ubah_password.php" class="btn btn-warning me-2"><i class="bi bi-key"></i> Ubah Password</a>
        </div>
    </div>
</body>

</html>
