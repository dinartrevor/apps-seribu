<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        global $conn;
        $user = getUserProfile($_SESSION['user']['npm']);
        $title  = $_POST['title'];
        $amount = str_replace(',', '', $_POST['amount']);
        $notes = $_POST['notes'];
        $payment_method_id = $_POST['payment_method_id'];
        $account_number = $_POST['account_number'];
        $account_holder_name = $_POST['account_holder_name'];
        $user_id = $user['id'];
        // Image handling
        $image = '';  // Default empty string
        if (!empty($_FILES['image']['name'])) {
			$image = uploadImage($_FILES['image']);
        }
        $insertSql = "INSERT INTO donations (user_id, title, amount, image, notes) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);

        // Use "ss" for two string parameters
        $insertStmt->bind_param("isdss", $user_id, $title, $amount, $image, $notes);
        $insertStmt->execute();
        // ID Role
        $lastInsertedId = $conn->insert_id;
        $insertStmt->close();

        if (!empty($payment_method_id)) {
            foreach ($payment_method_id as $key => $value) {
                $insertToRole = "INSERT INTO donation_payment_methods (donation_id, payment_method_id, account_number, account_holder_name) VALUES (?, ?, ?, ?)";
                $storeRole = $conn->prepare($insertToRole);

                // Use "ss" for two string parameters
                $storeRole->bind_param("iiss", $lastInsertedId, $value, $account_number[$key], $account_holder_name[$key]);
                $storeRole->execute();
                $storeRole->close();
            }
        }

        redirectUserSuccess('Data Donasi Berhasil dibuat');

    } catch (Exception $e) {
        redirectUserError('Error: ' . $e->getMessage());
    }
}

function uploadImage($file)
{
    $target_dir = "../../uploads/";
	$randomString = str_replace('.', '', uniqid('', true));
	$file_name = $randomString . '_' . uniqid() . '.' . pathinfo($file["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir .  $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($file["tmp_name"]);
	
    if ($check !== false) {
		$uploadOk = 1;
    } else {
		$uploadOk = 0;
    }
    if ($file["size"] > 3500000) {
		$uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return '';
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $file_name;
        } else {
            return '';
        }
    }
}
?>
