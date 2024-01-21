<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $deleted_by = $_SESSION['user']['name'];
        $deleted_at = date('Y-m-d H:i:s');

        $updateSql = "UPDATE roles SET deleted_by=?, deleted_at=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $deleted_by, $deleted_at, $id);
        $updateStmt->execute();
        $updateStmt->close();

        $deleteSql = "DELETE FROM role_permissions WHERE role_id=?";
        $deleteRolePermission = $conn->prepare($deleteSql);
        $deleteRolePermission->bind_param("i", $id);
        $deleteRolePermission->execute();
        $deleteRolePermission->close();

        $response = [
            "message" => "Data Berhasil",
            "status" => true,
        ];

        echo json_encode($response);
    } catch (Exception $e) {
        $response = [
            "message" => 'Error: ' . $e->getMessage(),
            "status" => false,
        ];
        echo json_encode($response);
    }
}
