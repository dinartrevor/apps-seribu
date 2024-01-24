<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $idPermission = $_POST['permission'];
        $created_by = $_SESSION['user']['name'];
        global $conn;

        $insertSql = "INSERT INTO roles (name, created_by) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);

        // Use "ss" for two string parameters
        $insertStmt->bind_param("ss", $name, $created_by);
        $insertStmt->execute();
        // ID Role
        $lastInsertedId = $conn->insert_id;
        $insertStmt->close();

        if(!empty($idPermission)) {
            foreach($idPermission as $value) {
                $insertToRole = "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
                $storeRole = $conn->prepare($insertToRole);

                // Use "ss" for two string parameters
                $storeRole->bind_param("ii", $lastInsertedId, $value);
                $storeRole->execute();
                $storeRole->close();
            }
        }

        $_SESSION['message_success'] = 'Data Role Berhasil ditambahkan';
        header("Location: ../../admin/role.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['message_error'] = 'Error: ' . $e->getMessage();
        header("Location: ../../admin/role.php");
        exit();
    }
}
?>
