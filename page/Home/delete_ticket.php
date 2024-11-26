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

// Hapus tiket dari database
$query = "DELETE FROM tickets WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $ticket_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    header("Location: dashboard.php"); // Setelah hapus, kembali ke dashboard
    exit();
} else {
    echo "Error deleting ticket.";
}
?>
