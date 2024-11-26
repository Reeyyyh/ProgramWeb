<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Traveling</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../controller/logout_logic.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mb-3">Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h1>
                <p class="lead">Ini adalah dashboard Anda. Kelola tiket dan lihat informasi terbaru di sini.</p>
            </div>
        </div>
    </div>

    <!-- Add Ticket Button -->
    <div class="container text-center mb-3">
        <a href="add_ticket.php" class="btn btn-success">Tambah Tiket Baru</a>
    </div>

    <!-- Ticket Section -->
    <div class="container mt-5">
        <h2 class="text-center">Tiket Anda</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Tiket</th>
                        <th>Harga</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../config/db_connect.php';
                    
                    // Ambil user_id dari sesi
                    $user_id = $_SESSION['user_id'];

                    // Query untuk mendapatkan tiket milik user
                    $query = "SELECT * FROM tickets WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($ticket = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>" . htmlspecialchars($ticket['name']) . "</td>
                                <td>Rp" . number_format($ticket['price'], 0, ',', '.') . "</td>
                                <td>{$ticket['created_at']}</td>
                                <td>
                                    <a href='edit_ticket.php?id={$ticket['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_ticket.php?id={$ticket['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus tiket ini?\");'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Anda belum memiliki tiket.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
