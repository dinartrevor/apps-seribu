<?php
session_start();

require_once '../database.php';
require_once '../helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        global $conn;
        $user = getUserProfile($_SESSION['user']['npm']);
        $donation_id  = $_POST['donation_id'];
        $user_id = $user['id'];
        $payment_method_id = $_POST['payment_method_id'];

        $name  = $_POST['name'];
        $status = 1;
        $donation_date = date("Y-m-d");
        $amount = str_replace(',', '', $_POST['amount']);
        $notes = $_POST['notes'];
        // Image handling
        $image = '';  // Default empty string
        if (!empty($_FILES['image']['name'])) {
			$image = uploadImage($_FILES['image']);
        }
        $insertSql = "INSERT INTO donors (donation_id, user_id, payment_method_id, name, status, donation_date, amount, image, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);

        // Use "ss" for two string parameters
        $insertStmt->bind_param("iiisisdss", $donation_id, $user_id, $payment_method_id, $name, $status, $donation_date, $amount, $image, $notes);
        $insertStmt->execute();
        $insertStmt->close();

        redirectUserSuccess('Berhasil Mendonor');
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
