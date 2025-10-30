<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembimbing Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../index.css">
    <style>
        body {
            background: url('https://images.pexels.com/photos/2291789/pexels-photo-2291789.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-form {
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.8);
            padding: 40px 30px;
            max-width: 600px;
            margin: 60px auto;
        }
        .form-title {
            color: #388e3c;
            font-weight: bold;
            text-align: center;
            margin-bottom: 24px;
            text-transform: uppercase;
        }
        .form-label {
            font-weight: 500;
            color: #2e7d32;
        }
        .btn-primary {
            background-color: #388e3c;
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="card-form">
        <h3 class="form-title"><i class="bi bi-person-badge"></i> Tambah Pembimbing</h3>
        <form action="../../backend/query/addPembimbing.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" />
                </div>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="tambah" style="width: auto; margin: 0 auto; display: block;">
                <i class="bi bi-check-circle"></i> Tambah Pembimbing
            </button>
        </form>
    </div>
</body>
</html>
