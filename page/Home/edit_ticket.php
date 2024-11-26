<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

require_once '../../config/db_connect.php';

// Ambil ID tiket dari URL
if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];
} else {
    header("Location: dashboard.php"); // Jika ID tidak ada, kembali ke dashboard
    exit();
}

// Ambil data tiket yang akan diedit
$query = "SELECT * FROM tickets WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $ticket_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ticket = $result->fetch_assoc();
} else {
    header("Location: dashboard.php"); // Tiket tidak ditemukan
    exit();
}

// Proses form edit tiket
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Update tiket
    $update_query = "UPDATE tickets SET name = ?, price = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssii", $name, $price, $ticket_id, $_SESSION['user_id']);
    
    if ($update_stmt->execute()) {
        header("Location: dashboard.php"); // Setelah update, kembali ke dashboard
        exit();
    } else {
        echo "Error updating ticket.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tiket</title>
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

    <!-- Edit Ticket Form -->
    <div class="container mt-5">
        <h2 class="text-center">Edit Tiket</h2>
        <form action="edit_ticket.php?id=<?php echo $ticket_id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Tiket</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($ticket['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($ticket['price']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
