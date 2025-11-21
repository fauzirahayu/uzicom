<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Akun Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/jamaah.css" />
    <style>

    </style>
</head>

<body>
    <div class="header"><i class="bi bi-person-badge"></i>Kelola Akun Admin</div>
    <div class="container">
        <div class="actions mb-4">
            <form method="GET" class="d-flex position-relative" action="" onsubmit="showLoading()">
                <input type="text" class="form-control me-2" name="cari" placeholder="Cari username atau email admin..." value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Cari</button>
                <div id="loading-spinner">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-2 text-success">Mencari data...</div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../../backend/database.php';
                    $no = 1;
                    $filter = '';
                    if (isset($_GET['cari']) && $_GET['cari'] != '') {
                        $cari = $conn->real_escape_string($_GET['cari']);
                        $filter = " WHERE username LIKE '%$cari%' OR email LIKE '%$cari%'";
                    }
                    $sql = "SELECT * FROM admin" . $filter;
                    $tampil = $conn->query($sql);
                    while ($data = mysqli_fetch_assoc($tampil)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td>
                                <a href='editAdmin.php?id=<?php echo $data['id']; ?>' class="edit-btn"><i class="bi bi-pencil"></i></a>
                                <a href='../../backend/query/hapusAdmin.php?id=<?php echo $data['id']; ?>' class="hapus-btn"
                                    onclick="return confirm('Yakin ingin menghapus akun admin ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function showLoading() {
            var spinner = document.getElementById('loading-spinner');
            spinner.classList.add('active');
        }
        window.onload = function() {
            var spinner = document.getElementById('loading-spinner');
            spinner.classList.remove('active');
        }
    </script>
</body>

</html>
