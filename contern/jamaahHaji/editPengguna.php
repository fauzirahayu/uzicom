<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}
include '../../backend/database.php';

$id = intval($_GET['id'] ?? 0);
if ($id < 1) {
    echo 'ID tidak valid.';
    exit;
}

$sql = "SELECT * FROM pengguna WHERE id = $id";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo 'Data tidak ditemukan.';
    exit;
}
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <style>
        html, body {
            height: 100vh;
        }
        body {
            background: url('https://images.pexels.com/photos/2291789/pexels-photo-2291789.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-form {
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            background: rgba(255,255,255,0.7);
            padding: 40px 30px;
        }
        .form-title {
            color: #388e3c;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
            color: #2e7d32;
            text-align: left;
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }
        .btn-primary {
            background-color: #388e3c;
            border-color: #388e3c;
            font-weight: bold;
            padding: 10px 40px;
        }
        .btn-primary:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card card-form">
            <h3 class="form-title"><i class="bi bi-person-badge"></i> Edit Pengguna</h3>
            <form action="../../backend/query/updatePengguna.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Password Baru (biarkan kosong jika tidak diubah)</label>
                  <input type="password" class="form-control" name="password" />
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-4" name="edit">
                <i class="bi bi-save"></i> Simpan Perubahan
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
