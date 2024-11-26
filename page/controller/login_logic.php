<?php
session_start();

require_once '../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['Email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $query = "SELECT id, username, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashed_password = $user['password'];

            if (password_verify($password, $hashed_password)) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Debugging untuk memastikan session diset dengan benar
                // var_dump($_SESSION); // Hapus setelah debugging selesai

                header("Location: ../../page/Home/Dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Password salah!";
            }
        } else {
            $_SESSION['error'] = "Email tidak ditemukan!";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Harap isi semua field!";
    }
}

header("Location: ../views/login.php");
exit();
?>
