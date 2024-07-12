<!-- app/Views/notifikasi_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <!-- Integrasi Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container mt-4">
        <h2>Notifikasi</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengiriman Notifikasi</h5>
                <p class="card-text">Pilih opsi untuk mengirim notifikasi:</p>
                <a href="<?= base_url('notifikasi/dosen-tidak-masuk/1') ?>" class="btn btn-primary">Dosen Tidak Masuk</a>
                <a href="<?= base_url('notifikasi/dosen-masuk/1') ?>" class="btn btn-success">Dosen Masuk</a>
            </div>
        </div>
    </div>

    <!-- Integrasi Bootstrap JS (Optional, jika Anda memerlukan fitur-fitur seperti dropdown) -->
    <script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
</body>
</html>
