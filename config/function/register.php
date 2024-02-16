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
            $role_id = 2;
            $status = 2;
            $created_by = $_POST['name'];
            global $conn;
            if(!empty(uniqueEmail($email))){
                $_SESSION['error'] = 'Email Sudah Ada';
                header("Location: ../../register.php");
                exit();
            }
            if(!empty(uniqueNpm($npm))){
                $_SESSION['error'] = 'NPM Sudah Ada';
                header("Location: ../../register.php");
                exit();
            }
            $insertSql = "INSERT INTO users (name, email, password, npm, role_id, created_by, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("sssiisi", $name, $email, $hashedPassword, $npm, $role_id, $created_by, $status);
            $insertStmt->execute();
            $insertStmt->close();

            $_SESSION['success'] = 'Berhasil Register';
            header("Location: ../../login.php");
            exit();

        } catch (Exception $e) {

            $_SESSION['error'] = 'Error: ' . $e->getMessage();
            header("Location: .../../register.php");
            exit();
        }
    }
