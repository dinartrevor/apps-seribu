<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $id = $_GET['id'];
        global $conn;
        $sql = "SELECT donations.id as donation_id, payment_methods.name, payment_methods.type, payment_methods.id, donation_payment_methods.account_number, donation_payment_methods.account_holder_name
        FROM payment_methods
        JOIN  donation_payment_methods ON payment_methods.id = donation_payment_methods.payment_method_id
        JOIN  donations ON donation_payment_methods.donation_id = donations.id
        WHERE payment_methods.deleted_by IS NULL AND  donations.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $stmt->close();
        $response = [
            "message" => "Data Berhasil",
            "status" => true,
            "data" => $users,
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        $response = [
            "message" => 'Error: ' . $e->getMessage(),
            "status" => false,
            "data" => [],
        ];
        echo json_encode($response);
    }
}
