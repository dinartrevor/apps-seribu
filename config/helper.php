<?php
	require_once 'database.php';

	function getUser($email) {
		global $conn;
		$sql = "SELECT users.name, users.email, users.id, users.npm, users.role_id, users.password, roles.name as role_name, users.status FROM users
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

	function getUserProfile($npm) {
		global $conn;
		$sql = "SELECT users.name, users.email, users.id, users.npm, users.role_id, users.password, roles.name as role_name, users.status FROM users
				JOIN roles ON users.role_id = roles.id
				WHERE users.npm = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $npm);
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();
		$stmt->close();

		return $user;
	}

    function getAllRole() {
		global $conn;
		$sql = "SELECT * FROM roles WHERE deleted_at IS NULL";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$roles = [];
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }

        $stmt->close();

        return $roles;
	}
	function getAllRolePermission($id) {
		global $conn;
		$sql = "SELECT * FROM role_permissions WHERE role_id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$roles = [];
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }

        $stmt->close();

        return $roles;
	}
    function getAllUser() {
		global $conn;
		$sql = "SELECT users.name, users.email, users.id, users.npm, users.role_id, users.password, users.created_at, users.status, roles.name as role_name FROM users
                JOIN roles ON users.role_id = roles.id WHERE roles.id != 1 AND users.deleted_by IS NULL";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $stmt->close();
        return $users;
	}
    function getAllPaymentMethod() {
		global $conn;
		$sql = "SELECT name, type, id, created_at FROM payment_methods
                WHERE deleted_by IS NULL";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $stmt->close();
        return $users;
	}
    function getAllPaymentMethodByUser($user_id) {
		global $conn;
		$sql = "SELECT donations.id as donation_id, payment_methods.name, payment_methods.type, payment_methods.id, donation_payment_methods.account_number, donation_payment_methods.account_holder_name
                FROM payment_methods
                JOIN  donation_payment_methods ON payment_methods.id = donation_payment_methods.payment_method_id
                JOIN  donations ON donation_payment_methods.donation_id = donations.id
                WHERE payment_methods.deleted_by IS NULL AND  donations.user_id = ?";
		$stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
		$stmt->execute();

		$result = $stmt->get_result();
		$users = [];
        while ($row = $result->fetch_assoc()) {
            $users[$row['donation_id']][] = $row;
        }
        $stmt->close();
        return $users;
	}
    function getUserRole($email){
        global $conn;
		$sql = "SELECT roles.name FROM users
				JOIN roles ON users.role_id = roles.id
				WHERE users.email = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		$stmt->close();

		return $user['name'];
    }
     function getAllPermission(){
        global $conn;
		$sql = "SELECT * FROM permissions";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$permissions = [];
        while ($row = $result->fetch_assoc()) {
            $permissions[] = $row;
        }

        $stmt->close();

        return $permissions;
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

	function getAllDonation() {
		global $conn;
		$sql = "SELECT users.name, donations.*, sum(donors.amount) as donor_amount FROM donations
                JOIN users ON donations.user_id = users.id
                LEFT JOIN donors ON donations.id = donors.donation_id
                WHERE donations.deleted_at IS NULL GROUP BY donations.id ORDER BY donations.created_at DESC ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }
        $stmt->close();
        return $donations;
	}
	function getAllDonor() {
		global $conn;
		$sql = "SELECT donors.user_id, donors.donation_date, sum(donors.amount) as donor_amount, donors.name as donor_name
                FROM donors
                GROUP BY donors.user_id, donors.donation_date,donors.name";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }
        $stmt->close();
        return $donations;
	}

	function getByUserDonationWithDeleted($user_id) {
		global $conn;
		$sql = "SELECT users.name, donations.* FROM donations
                JOIN users ON donations.user_id = users.id WHERE users.id = $user_id";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }
        $stmt->close();
        return $donations;
	}

    function getByUserDonorWithDeleted($user_id) {
		global $conn;
		$sql = "SELECT donations.title as donation_name,payment_methods.name as payment_name, donors.* FROM donors
                JOIN donations ON donors.donation_id = donations.id
                JOIN payment_methods ON donors.payment_method_id = payment_methods.id
                WHERE donors.user_id = $user_id";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->get_result();
		$donors = [];
        while ($row = $result->fetch_assoc()) {
            $donors[] = $row;
        }
        $stmt->close();
        return $donors;
	}

    function uniqueEmail($email) {
		global $conn;
		$sql = "SELECT users.id FROM users WHERE users.email = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();
		$stmt->close();

		return $user['id'];
	}
    function uniqueNpm($npm) {
		global $conn;
		$sql = "SELECT users.id FROM users WHERE users.npm = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $npm);
		$stmt->execute();

		$result = $stmt->get_result();
		$user = $result->fetch_assoc();
		$stmt->close();

		return $user['id'];
	}

	function loginUser($user) {
		$_SESSION['user'] = [
			'id' => $user['id'],
			'name' => $user['name'],
			'email' => $user['email'],
			'npm' => $user['npm'],
			'role_id' => $user['role_id'],
			'role_name' => $user['role_name'],
			'status' => $user['status'],
		];
	}

	function redirectToDashboard($role_id) {
		if ($role_id == 1) {
			header('Location: ../../admin/index.php');
		} else {
			header('Location: ../../index.php');
		}
		exit();
	}

	function redirectWithError($errorMessage) {
		$_SESSION['error'] = $errorMessage;
		header('Location: ../../login.php');
		exit();
	}

	function redirectUserError($message) {
		$_SESSION['message_error'] = $message;
		header("Location: ../../profile.php");
		exit();
	}

	function redirectUserSuccess($message) {
    $_SESSION['message_success'] = $message;
    header("Location: ../../profile.php");
    exit();
}

	function isDebug($debug) {
		echo "<pre>";print_r($debug);echo "</pre>";die;
	}

	function checkIsUser() {
		if (!empty($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
			header('Location: ../admin/index.php');
		}elseif (!empty($_SESSION['user']) && $_SESSION['user']['role_id'] != 1) {
            header('Location: ../index.php');
        }
	}

	function checkIsNotUser() {
		if (empty($_SESSION['user'])) {
			header('Location: ../login.php');
			exit();
		}elseif (!empty($_SESSION['user']) && $_SESSION['user']['role_id'] != 1) {
            header('Location: ../index.php');
        }
	}
?>
