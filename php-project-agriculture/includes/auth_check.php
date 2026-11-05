<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // works from any folder depth
    $prefix = (basename(dirname($_SERVER['SCRIPT_FILENAME'])) === basename(dirname(__DIR__))) ? '' : '../';
    header("Location: {$prefix}auth/login.php");
    exit;
}
