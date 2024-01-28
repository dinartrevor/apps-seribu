<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user = getUserProfile($_SESSION['user']['npm']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            redirectUserError('Error: Wajib Diisi, Tidak Boleh Kosong');
        }

        if (!password_verify($current_password, $user['password'])) {
            redirectUserError('Error: Password Tidak Sama');
        }

        if ($new_password != $confirm_password) {
            redirectUserError('Error: Password Tidak Sama');
        }

        if (empty($user)) {
            redirectUserError('Error: User Tidak Ada');
        }

        global $conn;
        $id = $user['id'];

        $selectSql = "SELECT * from users WHERE users.id = ?";
        $selectStmt = $conn->prepare($selectSql);
        $selectStmt->bind_param("s", $id);
        $selectStmt->execute();

        $result = $selectStmt->get_result();
        $user = $result->fetch_assoc();
        $selectStmt->close();

        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $updated_by = $user['name'];

        $updateSql = "UPDATE users SET password=?, updated_by=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $hashedPassword, $updated_by, $id);
        $updateStmt->execute();
        $updateStmt->close();

        unset($_SESSION['user']);
        $_SESSION['success'] = 'Password Berhasil diubah, silahkan login kembali';
        header('Location: ../../login.php');
        exit();

    } catch (Exception $e) {
        redirectUserError('Error: ' . $e->getMessage());
    }
}
