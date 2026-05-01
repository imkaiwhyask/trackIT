<?php
// Run from the repo root: php tools/patch_it_role_check.php
// This safely adds an IT-role check to src/it/index.php without replacing the whole file.

$file = __DIR__ . '/../src/it/index.php';
if (!file_exists($file)) {
    fwrite(STDERR, "Cannot find src/it/index.php. Run this from your trackIT repo root.\n");
    exit(1);
}

$contents = file_get_contents($file);
if (strpos($contents, "// SECURITY: block non-IT users") !== false) {
    echo "IT role check already exists. No changes made.\n";
    exit(0);
}

$old = <<<'PHP_OLD'
$query=mysqli_query($con,"SELECT * FROM tbl_user where id='".$_SESSION['uidrps']."'");

$row=mysqli_fetch_assoc($query);
PHP_OLD;

$new = <<<'PHP_NEW'
$stmt = $con->prepare("SELECT * FROM tbl_user WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $_SESSION['uidrps']);
$stmt->execute();
$query = $stmt->get_result();
$row = $query->fetch_assoc();
$stmt->close();

// SECURITY: block non-IT users from directly opening the IT dashboard.
if (!$row || $row['role'] !== 'IT') {
    header('Location:../main/?unauthorized');
    exit;
}
PHP_NEW;

if (strpos($contents, $old) === false) {
    fwrite(STDERR, "Could not find the exact target block. Please add the role check manually after the tbl_user lookup.\n");
    exit(1);
}

$contents = str_replace($old, $new, $contents);
file_put_contents($file, $contents);
echo "Done: IT role check added to src/it/index.php\n";
