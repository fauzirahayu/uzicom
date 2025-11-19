?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Jamaah Haji</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    html,
    body {
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
      background: rgba(255, 255, 255, 0.7);
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
  <?php
  include __DIR__ . '/../../backend/database.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM jamaah_haji WHERE id=$id";
  $tampil = $conn->query($sql);
  $data = mysqli_fetch_assoc($tampil);
  ?>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card card-form">
          <h3 class="form-title"><i class="bi bi-pencil-square"></i> Edit Data Jamaah Haji</h3>
          <form action="../../backend/query/updateJamaah.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
            <div class="row g-4">
              <div class="col-md-6">
                <label for="id_pembimbing" class="form-label">Pembimbing</label>
                <select class="form-select" id="id_pembimbing" name="id_pembimbing" required>
                  <option value="" disabled>Pilih Pembimbing</option>
                  <?php
                  $sqlPembimbing = "SELECT id, nama_lengkap FROM pembimbing_haji";
                  $resultPembimbing = $conn->query($sqlPembimbing);
                  while ($rowPembimbing = $resultPembimbing->fetch_assoc()) {
                    $selected = ($rowPembimbing['id'] == $data['id_pembimbing']) ? 'selected' : '';
                    echo '<option value="' . $rowPembimbing['id'] . '" ' . $selected . '>' . htmlspecialchars($rowPembimbing['nama_lengkap']) . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>" min="0" required readonly />
              </div>
              <div class="col-md-6">
                <label for="no_porsi" class="form-label">No Porsi</label>
                <input type="text" class="form-control" id="no_porsi" name="no_porsi" value="<?= $data['no_porsi'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jenis_kelamin" required>
                  <option disabled>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="number" class="form-control" id="telepon" name="telepon" value="<?= $data['telepon'] ?>" min="0" required />
              </div>
              <div class="col-md-6">
                <label for="no_paspor" class="form-label">No Paspor</label>
                <input type="text" class="form-control" id="no_paspor" name="no_paspor" value="<?= $data['no_paspor'] ?>" />
              </div>
              <div class="col-md-6">
                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                <select class="form-select" id="golongan_darah" name="golongan_darah">
                  <option value="" disabled>Pilih Golongan Darah</option>
                  <option value="A" <?= $data['golongan_darah'] == 'A' ? 'selected' : '' ?>>A</option>
                  <option value="B" <?= $data['golongan_darah'] == 'B' ? 'selected' : '' ?>>B</option>
                  <option value="AB" <?= $data['golongan_darah'] == 'AB' ? 'selected' : '' ?>>AB</option>
                  <option value="O" <?= $data['golongan_darah'] == 'O' ? 'selected' : '' ?>>O</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="penyakit_bawaan" class="form-label">Penyakit Bawaan</label>
                <input type="text" class="form-control" id="penyakit_bawaan" name="penyakit_bawaan" value="<?= $data['penyakit_bawaan'] ?>" />
              </div>
              <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="Lunas" <?= $data['status'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                  <option value="Belum lunas" <?= $data['status'] == 'Belum lunas' ? 'selected' : '' ?>>Belum lunas</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="jadwal_berangkat" class="form-label">Jadwal Berangkat</label>
                <div class="row g-2">
                  <div class="col-6">
                    <select class="form-select" id="bulan" name="bulan" required>
                      <option value="" disabled>Pilih Bulan</option>
                      <option value="01" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '01' ? 'selected' : '' ?>>Januari</option>
                      <option value="02" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '02' ? 'selected' : '' ?>>Februari</option>
                      <option value="03" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '03' ? 'selected' : '' ?>>Maret</option>
                      <option value="04" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '04' ? 'selected' : '' ?>>April</option>
                      <option value="05" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '05' ? 'selected' : '' ?>>Mei</option>
                      <option value="06" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '06' ? 'selected' : '' ?>>Juni</option>
                      <option value="07" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '07' ? 'selected' : '' ?>>Juli</option>
                      <option value="08" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '08' ? 'selected' : '' ?>>Agustus</option>
                      <option value="09" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '09' ? 'selected' : '' ?>>September</option>
                      <option value="10" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '10' ? 'selected' : '' ?>>Oktober</option>
                      <option value="11" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '11' ? 'selected' : '' ?>>November</option>
                      <option value="12" <?= !empty($data['jadwal_berangkat']) && date('m', strtotime($data['jadwal_berangkat'])) == '12' ? 'selected' : '' ?>>Desember</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <select class="form-select" id="tanggal" name="tanggal" required>
                      <option value="" disabled selected>Pilih Tanggal</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" id="jadwal_berangkat" name="jadwal_berangkat" value="<?= $data['jadwal_berangkat'] ?>">
              </div>
              <div class="col-md-6">
                <label for="foto" class="form-label">Foto Jamaah</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                <?php if (!empty($data['foto'])): ?>
                  <img src="../../uploads/<?= $data['foto'] ?>" id="preview" class="img-preview" alt="Foto Jamaah Lama" />
                <?php else: ?>
                  <img id="preview" class="img-preview" style="display: none;" />
                <?php endif; ?>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary" name="update">
                <i class="bi bi-save"></i> Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const input = event.target;
      const preview = document.getElementById('preview');
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    document.getElementById('bulan').addEventListener('change', function() {
      const bulan = this.value;
      const tanggalSelect = document.getElementById('tanggal');
      const jadwalBerangkat = document.getElementById('jadwal_berangkat');
      tanggalSelect.innerHTML = '<option value="" disabled selected>Pilih Tanggal</option>';

      if (bulan) {
        const daysInMonth = new Date(2026, bulan, 0).getDate();
        for (let day = 1; day <= daysInMonth; day++) {
          const option = document.createElement('option');
          option.value = day.toString().padStart(2, '0');
          option.textContent = day;
          tanggalSelect.appendChild(option);
        }
      }

      // Set selected tanggal if jadwal_berangkat exists
      if (jadwalBerangkat.value) {
        const selectedDate = new Date(jadwalBerangkat.value);
        const selectedDay = selectedDate.getDate().toString().padStart(2, '0');
        tanggalSelect.value = selectedDay;
      }
    });

    document.getElementById('tanggal').addEventListener('change', function() {
      const bulan = document.getElementById('bulan').value;
      const tanggal = this.value;
      const jadwalBerangkat = document.getElementById('jadwal_berangkat');

      if (bulan && tanggal) {
        jadwalBerangkat.value = `2026-${bulan}-${tanggal}`;
      }
    });

    // Trigger change on load to populate tanggal if bulan is selected
    window.addEventListener('DOMContentLoaded', function() {
      const bulanSelect = document.getElementById('bulan');
      if (bulanSelect.value) {
        bulanSelect.dispatchEvent(new Event('change'));
      }
    });
  </script>
</body>

</html>