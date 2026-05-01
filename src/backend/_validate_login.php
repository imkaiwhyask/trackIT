<?php
session_start();
include('../config/config.php');

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location:../?invalid');
    exit;
}

$stmt = $con->prepare("SELECT id, login, password, role FROM tbl_user WHERE login = ? AND status = 'active' LIMIT 1");
if (!$stmt) {
    error_log('Login prepare failed: ' . $con->error);
    header('Location:../?invalid');
    exit;
}

$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$isValid = false;
$storedPassword = $user['password'] ?? '';

if ($user) {
    // New secure hashes created by password_hash()
    if (password_verify($password, $storedPassword)) {
        $isValid = true;
    }

    // Backward compatibility for existing SHA1 passwords.
    // When a SHA1 login succeeds, automatically upgrade it to password_hash().
    if (!$isValid && strlen($storedPassword) === 40 && ctype_xdigit($storedPassword) && hash_equals($storedPassword, sha1($password))) {
        $isValid = true;
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        $update = $con->prepare('UPDATE tbl_user SET password = ? WHERE id = ?');
        if ($update) {
            $update->bind_param('si', $newHash, $user['id']);
            $update->execute();
            $update->close();
        }
    }
}

if (!$isValid) {
    header('Location:../?invalid');
    exit;
}

session_regenerate_id(true);
$_SESSION['uidrps'] = $user['id'];

if ($user['role'] === 'USER') {
    header('Location:../main/?laptop');
    exit;
}

if ($user['role'] === 'IT') {
    header('Location:../it/?inv=laptop');
    exit;
}

header('Location:../?invalid');
exit;
?>
