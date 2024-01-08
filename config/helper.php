<?php 
	require_once 'database.php';

	function getUser($email) {
		global $conn;
		$sql = "SELECT * FROM users 
				JOIN roles ON users.role_id = roles.id 
				WHERE users.email = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		$stmt->close();

		return $user;
	}

	function hasPermission($email, $permissionName) {
		global $conn;
		$userRole = getUserRole($email);
		$sql = "SELECT COUNT(*) as count FROM role_permissions 
				JOIN permissions ON role_permissions.permission_id = permissions.id 
				WHERE role_permissions.role_id = (SELECT id FROM roles WHERE name = ?) 
				AND permissions.name = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $userRole, $permissionName);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row['count'] > 0;
	}

	function loginUser($user) {
		$_SESSION['user'] = [
			'id' => $user['id'],
			'name' => $user['name'],
			'email' => $user['email'],
			'npm' => $user['npm'],
			'role_id' => $user['role_id'],
		];
	}
	
	function redirectToDashboard($role_id) {
		if ($role_id == 1) {
			header('Location: ../admin/index.php');
		} else {
			header('Location: ../index.php');
		}
		exit();
	}
	
	function redirectWithError($errorMessage) {
		$_SESSION['error'] = $errorMessage;
		header('Location: ../login.php');
		exit();
	}
	
	function isDebug($debug) {
		echo "<pre>";print_r($debug);echo "</pre>";die;
	}

	function checkIsUser() {
		if (!empty($_SESSION['user'])) {
			header('Location: ../admin/index.php');
		}
	}
	
	function checkIsNotUser() {
		if (empty($_SESSION['user'])) {
			header('Location: ../login.php');
			exit();
		}
	}
?>
