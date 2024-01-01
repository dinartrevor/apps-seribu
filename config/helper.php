<?php 
require_once 'database.php';


function getUserRole($email) {
  global $conn;
  $sql = "SELECT roles.name FROM users 
          JOIN roles ON users.role_id = roles.id 
          WHERE users.email = '$email'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['name'];
}

function hasPermission($email, $permissionName) {
  global $conn;
  $userRole = getUserRole($email);
  $sql = "SELECT COUNT(*) as count FROM role_permissions 
          JOIN permissions ON role_permissions.permission_id = permissions.id 
          WHERE role_permissions.role_id = (SELECT id FROM roles WHERE name = '$userRole') 
          AND permissions.name = '$permissionName'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['count'] > 0;
}