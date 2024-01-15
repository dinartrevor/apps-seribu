<?php
require_once 'database.php';

try {
	$conn->query('SET foreign_key_checks = 0');
    $conn->query("TRUNCATE TABLE role_permissions");
    $conn->query("TRUNCATE TABLE users");
    $conn->query("TRUNCATE TABLE roles");
    $conn->query("TRUNCATE TABLE permissions");
	$conn->query('SET foreign_key_checks = 1');

    // Seeder data
    $rolesData = [
        ['name' => 'Admin'],
        ['name' => 'User'],
    ];

    $permissionsData = [
        ['name' => 'dashboard-list'],
        ['name' => 'user_management'],
        ['name' => 'user-read'],
        ['name' => 'user-create'],
        ['name' => 'user-edit'],
        ['name' => 'user-delete'],
        ['name' => 'role-read'],
        ['name' => 'role-create'],
        ['name' => 'role-edit'],
        ['name' => 'role-delete'],
        ['name' => 'permission-read'],
        ['name' => 'permission-create'],
        ['name' => 'permission-edit'],
        ['name' => 'permission-delete'],
    ];

    $usersData = [
        [
			'name' => 'Superadmin',
			'email' => 'superadmin@sttb.ac.id',
			'password' => password_hash('password', PASSWORD_DEFAULT),
			'npm' => '',
			'role_id' => 1
		],
        [
			'name' => 'Dinar',
			'email' => 'superuser@sttb.ac.id',
			'password' => password_hash('123456789', PASSWORD_DEFAULT),
			'npm' => '21552011188',
			'role_id' => 2
		],
    ];

    $paymentMethods = [
        [
			'name' => 'BCA',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'BRI',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'MANDIRI',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'BNI',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'PERMATA BANK',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'NIAGA',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'MAYBANK',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'OCBC',
			'type' => 'Transfer Manual',
		],
        [
			'name' => 'GoPay',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'OVO',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'DANA',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'LinkAja',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'Shopee Pay',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'DOKU',
			'type' => 'E-Wallet',
		],
        [
			'name' => 'I-SAKU',
			'type' => 'E-Wallet',
		],
    ];

    foreach ($rolesData as $role) {
        $stmt = $conn->prepare("INSERT INTO roles (name) VALUES (?)");
        $stmt->bind_param("s", $role['name']);
        $stmt->execute();
        $stmt->close();
    }

    foreach ($permissionsData as $permission) {
        $stmt = $conn->prepare("INSERT INTO permissions (name) VALUES (?)");
        $stmt->bind_param("s", $permission['name']);
        $stmt->execute();
        $stmt->close();
    }

    foreach ($usersData as $user) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, npm,  role_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $user['name'], $user['email'], $user['password'], $user['npm'], $user['role_id']);
        $stmt->execute();
        $stmt->close();
    }

    foreach ($permissionsData as $key => $permission) {
		$role_id = 1;
		$permission_id = $key+1;
        $stmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $role_id, $permission_id);
        $stmt->execute();
        $stmt->close();
    }
    foreach ($paymentMethods as $key => $paymentMethod) {
        $stmt = $conn->prepare("INSERT INTO payment_methods (name, type) VALUES (?, ?)");
        $stmt->bind_param("ss", $paymentMethod['name'], $paymentMethod['type']);
        $stmt->execute();
        $stmt->close();
    }
    echo "Seeder executed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
?>
