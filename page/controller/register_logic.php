<?php
// Import konfigurasi database
require_once '../../config/db_connect.php';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Semua field wajib diisi.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid.");
    }

    if ($password !== $confirm_password) {
        die("Password dan Confirm Password tidak cocok.");
    }

    // Hash password sebelum menyimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    
    if ($stmt->execute()) {
        echo "Pendaftaran berhasil. <a href='../views/login.php'>Login sekarang</a>";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    die("Metode tidak diizinkan.");
}
?>