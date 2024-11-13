<?php
require_once 'sessioninactive.php';

$staffId = $_GET['id'];

include 'config.php';

$sql = "DELETE FROM staffDetails WHERE id = {$staffId}";
$result = mysqli_query($conn, $sql) or die("query failed");

if ($result) {
    header("Location: {$domain}/admin/staff-details.php");
}


mysqli_close($conn);
