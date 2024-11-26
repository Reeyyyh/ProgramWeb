<?php
session_start();

// Set zona waktu Jakarta
date_default_timezone_set('Asia/Jakarta');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

require_once '../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $ticket_name = $_POST['ticket_name'];
    $price = $_POST['price'];
    $created_at = date("Y-m-d H:i:s");  // Format waktu sesuai zona waktu

    // Simpan data ke database
    $query = "INSERT INTO tickets (user_id, name, price, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $ticket_name, $price, $created_at);

    if ($stmt->execute()) {
        // Jika berhasil, redirect ke dashboard dan set session sukses
        // $_SESSION['success'] = "Tiket berhasil ditambahkan!";
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika gagal, set session error
        $_SESSION['error'] = "Gagal menambahkan tiket.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Tiket</h4>
                    </div>
                    <div class="card-body">
                        <!-- Pesan sukses atau error -->
                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="ticket_name" class="form-label">Nama Tiket</label>
                                <input type="text" class="form-control" id="ticket_name" name="ticket_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
