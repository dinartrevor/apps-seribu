<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $deleted_at = date('Y-m-d H:i:s');

        $updateSql = "UPDATE donations SET deleted_at=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $deleted_at, $id);
        $updateStmt->execute();
        $updateStmt->close();

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
