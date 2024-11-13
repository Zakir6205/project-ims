<?php
session_start();

if (isset($_SESSION['adminusername'])) {
    header("Location: {$domain}/admin/admindashboard.php");
}
if (isset($_SESSION['staffusername'])) {
    header("Location: {$domain}/staff/staffdashboard.php");
}

