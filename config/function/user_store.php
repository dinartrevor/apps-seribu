<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $npm = $_POST['npm'];
        $role_id = $_POST['role_id'];
        $created_by = $_SESSION['user']['name'];
        global $conn;

        if(!empty(uniqueEmail($email))){
            $_SESSION['message_error'] = 'Email Sudah Ada';
            header("Location: ../../admin/user.php");
            exit();
        }

        if(!empty(uniqueNpm($npm))){
            $_SESSION['message_error'] = 'NPM Sudah Ada';
            header("Location: ../../admin/user.php");
            exit();
        }

        $insertSql = "INSERT INTO users (name, email, password, npm, role_id, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("sssiis", $name, $email, $hashedPassword, $npm, $role_id, $created_by);
        $insertStmt->execute();
        $insertStmt->close();

        $_SESSION['message_success'] = 'Data User Berhasil ditambahkan';
        header("Location: ../../admin/user.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['message_error'] = 'Error: ' . $e->getMessage();
        header("Location: ../../admin/user.php");
        exit();
    }
}
