<?php

header("Content-Type: application/json");

// Mulai session
session_start();  // Pastikan session dimulai di sini

// Debugging: Tampilkan session untuk memastikan session sudah ada
// var_dump($_SESSION);  // Hapus atau ganti dengan logging jika tidak ingin menampilkan ini secara langsung

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

// Koneksi ke database
require_once '../config/db_connect.php';

// Cek metode request
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Jika ada ID tiket di query string
        if (isset($_GET['ticket_id'])) {
            $ticket_id = intval($_GET['ticket_id']);
            $sql = "SELECT id, name, price, created_at FROM tickets WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $ticket_id, $user_id);
        } else {
            // Jika tidak ada ID tiket, ambil semua tiket untuk user tertentu
            $sql = "SELECT id, name, price, created_at FROM tickets WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $tickets = [];
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $row;
            }
            echo json_encode(["status" => "success", "data" => $tickets]);
        } else {
            echo json_encode(["status" => "success", "data" => []]);
        }
        break;

    case 'POST':
        // Ambil data dari body request (Postman)
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['ticket_name'], $data['price'])) {
            $ticket_name = $data['ticket_name'];
            $price = $data['price'];
            $created_at = date("Y-m-d H:i:s");  // Format waktu sesuai zona waktu

            // Simpan data tiket ke database
            $query = "INSERT INTO tickets (user_id, name, price, created_at) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isss", $user_id, $ticket_name, $price, $created_at);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Tiket berhasil ditambahkan!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menambahkan tiket."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
        }
        break;

    case 'PUT':
        // Ambil data dari body request (Postman)
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['ticket_id'], $data['ticket_name'], $data['price'])) {
            $ticket_id = $data['ticket_id'];
            $ticket_name = $data['ticket_name'];
            $price = $data['price'];

            // Update data tiket berdasarkan ticket_id dan user_id
            $query = "UPDATE tickets SET name = ?, price = ? WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssii", $ticket_name, $price, $ticket_id, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Tiket berhasil diperbarui!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal memperbarui tiket."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
        }
        break;

    case 'DELETE':
        // Ambil data dari body request (Postman)
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['ticket_id'])) {
            $ticket_id = $data['ticket_id'];

            // Hapus tiket berdasarkan ticket_id dan user_id
            $query = "DELETE FROM tickets WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $ticket_id, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Tiket berhasil dihapus!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menghapus tiket."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
        break;
}
?>
