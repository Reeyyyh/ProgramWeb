<?php
header("Content-Type: application/json");

require '../config/db_connect.php'; // Include koneksi database

// Menangani request GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Cek apakah parameter `id` ada
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Validasi ID sebagai angka
            $sql = "SELECT id, username, email FROM users WHERE id = $id";
        } else {
            $sql = "SELECT id, username, email FROM users";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            // Kirim response JSON
            echo json_encode([
                "status" => "success",
                "data" => $users
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "data" => []
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request POST (Create)
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['username'], $data['email'], $data['password'])) {
            $username = $data['username'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash password untuk keamanan

            // Query untuk menyimpan user baru
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil ditambahkan"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menambahkan user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request PUT (Update)
elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['id'], $data['username'], $data['email'])) {
            $id = intval($data['id']);
            $username = $data['username'];
            $email = $data['email'];

            // Query untuk update data user
            $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $username, $email, $id);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil diperbarui"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal memperbarui user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request DELETE
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['id'])) {
            $id = intval($data['id']);

            // Query untuk menghapus user
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil dihapus"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menghapus user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}
?>
