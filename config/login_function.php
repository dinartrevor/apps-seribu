<?php 
session_start();

require_once 'database.php';
require_once 'helper.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = getUser($email);
    if ($user && password_verify($password, $user['password'])) {
        loginUser($user);
        redirectToDashboard($user['role_id']);
    } else {
        redirectWithError('Invalid email or password.');
    }
}
