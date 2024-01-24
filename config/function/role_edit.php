<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $id = $_GET['id'];
        global $conn;
        $sql = "SELECT * from roles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        $idPermission = [];
        $rolePermission = getAllRolePermission($id);
        if(!empty($rolePermission)){
            foreach($rolePermission as $value){
                $idPermission[] = $value['permission_id'];
            }
        }

        $permissions = getAllPermission();
        if(!empty($permissions)){
            foreach($permissions as $key => $permission){
                $permissions[$key]['checked'] = '-';
                if(in_array($permission['id'], $idPermission)){
                    $permissions[$key]['checked'] = 'checked';
                }
            }
        }

        $response = [
            "message" => "Data Berhasil",
            "status" => true,
            "data" => $user,
            "permission" => $permissions,
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
