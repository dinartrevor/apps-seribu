<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $updated_by = $_SESSION['user']['name'];
        $deleted_at = date('Y-m-d H:i:s');

        $updateSql = "UPDATE users SET updated_by=?, status=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sii", $updated_by, $status, $id);
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
