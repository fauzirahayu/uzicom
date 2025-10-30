<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../../backend/database.php';

// Fetch news from database
$query = "SELECT id, judul, konten, tanggal_publikasi, penulis, gambar FROM berita ORDER BY tanggal_publikasi DESC";
$result = mysqli_query($conn, $query);
$berita = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Berita - Admin Jamaah Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../../dasboard/index.css">
</head>
<body>
    <div class="conten">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-newspaper"></i> Kelola Berita</h2>
            <a href="tambahBerita.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Berita
            </a>
        </div>

        <div class="row">
            <?php if (count($berita) > 0): ?>
                <?php foreach ($berita as $item): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <?php if ($item['gambar']): ?>
                                <img src="../../../uploads/<?php echo htmlspecialchars($item['gambar']); ?>" class="card-img-top" alt="Gambar Berita" style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['judul']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php echo date('d M Y', strtotime($item['tanggal_publikasi'])); ?> oleh <?php echo htmlspecialchars($item['penulis']); ?>
                                </p>
                                <p class="card-text">
                                    <?php echo substr(strip_tags($item['konten']), 0, 150) . '...'; ?>
                                </p>
                                <a href="detailBerita.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Belum ada berita yang tersedia.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
