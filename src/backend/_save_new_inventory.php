<?php
session_start();
include('../config/config.php');

if (!isset($_POST['submit'])) {
    header('Location:../it/?inv=laptop');
    exit;
}

$serial = trim($_POST['serial'] ?? '');
$employeeName = trim($_POST['employeeName'] ?? '');
$igg = trim($_POST['igg'] ?? '');
$department = trim($_POST['department'] ?? '');
$location = trim($_POST['location'] ?? '');
$remarks = trim($_POST['remarks'] ?? '');
$startDate = trim($_POST['startDate'] ?? '');
$byUser = trim($_POST['byUser'] ?? '');
$country = trim($_POST['country'] ?? '');
$inv = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['inv'] ?? 'laptop');
$now = date('Y-m-d H:i:s');

if ($serial === '' || $country === '') {
    die('Error: Missing required inventory information.');
}

function fail_and_exit($message) {
    die($message);
}

// Update asset status using a prepared statement.
$stmt = $con->prepare("UPDATE tbl_assetmain SET assetStatus = 'In Use', lastChanged = ?, byUser = ? WHERE serial = ? AND assetStatus = 'In Stock' AND country = ?");
if (!$stmt) {
    fail_and_exit('Error: Unable to prepare asset update.');
}
$stmt->bind_param('ssss', $now, $byUser, $serial, $country);
$stmt->execute();
$stmt->close();

$uploadedFilename = null;

// Upload permanent form safely.
if (isset($_FILES['permanentForm']) && $_FILES['permanentForm']['error'] === UPLOAD_ERR_OK) {
    $maxsize = 10 * 1024 * 1024; // 10MB

    if ($_FILES['permanentForm']['size'] > $maxsize) {
        fail_and_exit('Error: File size is larger than the allowed limit.');
    }

    $originalName = $_FILES['permanentForm']['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if ($ext !== 'pdf') {
        fail_and_exit('Error: Please select a valid PDF file.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES['permanentForm']['tmp_name']);

    if ($mime !== 'application/pdf') {
        fail_and_exit('Error: Uploaded file is not a valid PDF.');
    }

    $uploadDir = realpath(__DIR__ . '/../pdf');
    if ($uploadDir === false) {
        fail_and_exit('Error: Upload directory does not exist.');
    }

    $uploadedFilename = 'permanent_form_' . date('Ymd_His') . '_' . bin2hex(random_bytes(8)) . '.pdf';
    $destination = $uploadDir . DIRECTORY_SEPARATOR . $uploadedFilename;

    if (!move_uploaded_file($_FILES['permanentForm']['tmp_name'], $destination)) {
        fail_and_exit('Error: There was a problem uploading your file. Please try again.');
    }
}

// Insert asset log using prepared statements.
if ($uploadedFilename !== null) {
    $stmt = $con->prepare("INSERT INTO tbl_assetmainlogs (serial, assignedTo, igg, department, location, status, remarks, permanentForms, startDate, lastChanged, byUser, country) VALUES (?, ?, ?, ?, ?, 'active', ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        fail_and_exit('Error: Unable to prepare asset log insert.');
    }
    $stmt->bind_param('sssssssssss', $serial, $employeeName, $igg, $department, $location, $remarks, $uploadedFilename, $startDate, $now, $byUser, $country);
} else {
    $stmt = $con->prepare("INSERT INTO tbl_assetmainlogs (serial, assignedTo, igg, department, location, status, remarks, startDate, lastChanged, byUser, country) VALUES (?, ?, ?, ?, ?, 'active', ?, ?, ?, ?, ?)");
    if (!$stmt) {
        fail_and_exit('Error: Unable to prepare asset log insert.');
    }
    $stmt->bind_param('ssssssssss', $serial, $employeeName, $igg, $department, $location, $remarks, $startDate, $now, $byUser, $country);
}

$stmt->execute();
$logId = $stmt->insert_id;
$stmt->close();

// Update accessories only from safe whitelisted columns.
$allowedAccessoryColumns = [
    'bag',
    'keyboard',
    'mouse',
    'ups',
    'charger',
    'dockingStation',
    'monitor1',
    'monitor2',
];

if (isset($_POST['asset']) && is_array($_POST['asset']) && $logId > 0) {
    foreach ($_POST['asset'] as $column) {
        if (!in_array($column, $allowedAccessoryColumns, true)) {
            continue;
        }

        $sql = "UPDATE tbl_assetmainlogs SET `$column` = 'YES' WHERE serial = ? AND id = ? AND country = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sis', $serial, $logId, $country);
            $stmt->execute();
            $stmt->close();
        }
    }
}

header('Location:../it/?inv=' . urlencode($inv) . '&new&success');
exit;
?>
