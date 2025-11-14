<?php
include '../../backend/database.php';

$id = intval($_GET['id'] ?? 0);
if ($id < 1) {
    echo 'ID tidak valid.';
    exit;
}

$sql = "SELECT * FROM pembimbing_haji WHERE id = $id";
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
    <title>Edit Pembimbing Haji</title>
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
        .img-preview {
            max-width: 150px;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card card-form">
            <h3 class="form-title"><i class="bi bi-person-badge"></i> Edit Pembimbing</h3>
            <form action="../../backend/query/updatePembimbing.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" value="<?php echo htmlspecialchars($data['nama_lengkap']); ?>" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label">NIK</label>
                  <input type="number" class="form-control" name="nik" value="<?php echo htmlspecialchars($data['nik']); ?>" min="0" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Telepon</label>
                  <input type="number" class="form-control" name="telepon" value="<?php echo htmlspecialchars($data['telepon']); ?>" min="0" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Foto (biarkan kosong jika tidak diubah)</label>
                  <input type="file" class="form-control" name="foto" accept="image/*" />
                  <?php if ($data['foto']) { ?>
                    <img src="../../uploads/<?php echo $data['foto']; ?>" alt="Foto" style="width:80px;margin-top:8px;border-radius:8px;" />
                  <?php } ?>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Keterangan</label>
                  <textarea class="form-control" name="keterangan"><?php echo htmlspecialchars($data['keterangan']); ?></textarea>
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
