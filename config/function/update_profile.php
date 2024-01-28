<?php
session_start();

require_once '../database.php';
require_once '../helper.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user = getUserProfile($_SESSION['user']['npm']);
        $name = $_POST['name'];
        $email = $_POST['email'];

        if (empty($name) || empty($email)) {
            redirectUserError('Error: Wajib Diisi, Tidak Boleh Kosong');
        }

        if (empty($user)) {
            redirectUserError('Error: User Tidak Ada');
        }

        global $conn;
        $id = $user['id'];

        $selectSql = "SELECT * FROM users WHERE id = ?";
        $selectStmt = $conn->prepare($selectSql);
        $selectStmt->bind_param("s", $id);
        $selectStmt->execute();

        $result = $selectStmt->get_result();
        $user = $result->fetch_assoc();
        $selectStmt->close();

        $updated_by = $name;

        $updateSql = "UPDATE users SET name=?, email=?, updated_by=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssi", $name, $email, $updated_by, $id);
        $updateStmt->execute();
        $updateStmt->close();

        redirectUserSuccess('Data User Berhasil diupdate');

    } catch (Exception $e) {
        redirectUserError('Error: ' . $e->getMessage());
    }
}
