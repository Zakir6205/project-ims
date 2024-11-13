<?php
require_once 'sessioninactive.php';

$teacherId = $_GET['id'];

include 'config.php';

$sql = "DELETE FROM teacherDetails WHERE id = {$teacherId}";
$result = mysqli_query($conn, $sql) or die("query failed");

if ($result) {
    header("Location: {$domain}/admin/teacher-details.php");
}


mysqli_close($conn);