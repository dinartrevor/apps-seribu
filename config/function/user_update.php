<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        global $conn;

        $sql = "SELECT * from users WHERE users.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $npm = $_POST['npm'];
        $role_id = $_POST['role_id'];
        $updated_by = $_SESSION['user']['name'];

        $updateSql = "UPDATE users SET name=?, email=?, npm=?, role_id=?, updated_by=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssiisi", $name, $email, $npm, $role_id, $updated_by, $id);
        $updateStmt->execute();
        $updateStmt->close();

        $_SESSION['message_success'] = 'Data User Berhasil diupdate';
        header("Location: ../../admin/user.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['message_error'] = 'Error: ' . $e->getMessage();
        header("Location: ../../admin/user.php");
        exit();
    }
}
