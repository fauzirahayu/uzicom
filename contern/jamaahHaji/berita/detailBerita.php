<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../../backend/database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Fetch specific news article
$query = "SELECT * FROM berita WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$article = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($article['judul'] ?? 'Berita'); ?> - Admin Jamaah Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../../dasboard/index.css">
</head>
<body>
    <div class="conten">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-newspaper"></i> Detail Berita</h2>
            <a href="berita.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Berita
            </a>
        </div>

        <?php if ($article): ?>
            <div class="card">
                <div class="card-header">
                    <h3><?php echo htmlspecialchars($article['judul']); ?></h3>
                </div>
                <div class="card-body">
                    <?php if ($article['gambar']): ?>
                        <div class="text-center mb-4">
                            <img src="../../../uploads/<?php echo htmlspecialchars($article['gambar']); ?>" alt="Gambar Berita" class="img-fluid rounded">
                        </div>
                    <?php endif; ?>
                    <p class="text-muted">
                        <strong><?php echo date('d M Y', strtotime($article['tanggal_publikasi'])); ?> oleh <?php echo htmlspecialchars($article['penulis']); ?></strong>
                    </p>
                    <div class="content">
                        <?php echo nl2br($article['konten']); ?>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="editBerita.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="hapusBerita.php?id=<?php echo $article['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> Berita tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
