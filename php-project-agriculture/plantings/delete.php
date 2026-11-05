<?php
require_once __DIR__ . '/../includes/auth_check.php';

// Only Admin can delete
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Only an administrator can delete records.'];
    header("Location: index.php");
    exit;
}

$id = (int) ($_GET['id'] ?? 0);
// PROTOTYPE: the Model's delete($id) will be called here
$_SESSION['flash'] = ['type' => 'success', 'msg' => 'Planting deleted successfully.'];
header("Location: index.php");
exit;
