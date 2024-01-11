<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $id = $_GET['id'];
        global $conn;
        $sql = "SELECT * from users WHERE users.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        $roles = getAllRole();
        if(!empty($roles)){
            foreach ($roles as $key => $role) {
                if($role['id'] == $user['role_id']){
                    $roles[$key]['selected'] = 'selected';
                }else{
                    $roles[$key]['selected'] = '';
                }
            }
        }
        $response = [
            "message" => "Data Berhasil",
            "status" => true,
            "data" => $user,
            "roles" => $roles,
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        $response = [
            "message" => 'Error: ' . $e->getMessage(),
            "status" => false,
            "data" => [],
            "roles" => [],
        ];
        echo json_encode($response);
    }
}
