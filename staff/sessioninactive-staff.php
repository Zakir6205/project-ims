<?php
session_start();

if (!isset($_SESSION['staffusername'])) {
    header("Location: {$domain}/index.php");
}