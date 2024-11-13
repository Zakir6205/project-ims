<?php
$staffId = $_POST['id'];
$staffName = $_POST['staffName'];
$fName = $_POST['staff-fName'];
$mName = $_POST['staff-mName'];
$staffDob = $_POST['staffDob'];
$staffGender = $_POST['staffGender'];
$staffAdhar = $_POST['staffAdhar'];
$staffSVName = $_POST['staff-svName'];
$staffCName = $_POST['staff-cName'];
$staffDName = $_POST['staff-dName'];
$staffSName = $_POST['staff-sName'];
$staffCoName = $_POST['staff-coName'];
$staffPCode = $_POST['staff-pCode'];
$staffPhone = $_POST['staffPhone'];
$staffAphone = $_POST['staffAphone'];
$staffEmail = $_POST['staffEmail'];
$date = $_POST['addedDate'];
date_default_timezone_set("Asia/Kolkata");
$upDate = date("Y-m-d");

include_once 'config.php';

$sql = "UPDATE staffDetails SET staffName = '{$staffName}', fatherName = '{$fName}',motherName = '{$mName}',dob = '{$staffDob}',gender = '{$staffGender}',adharNo = '{$staffAdhar}',svName = '{$staffSVName}',cityName = '{$staffCName}',distName = '{$staffDName}',stateName = '{$staffSName}',countryName = '{$staffCoName}',pinCode = '{$staffPCode}',phoneNo = '{$staffPhone}',aPhoneNo = '{$staffAphone}',email = '{$staffEmail}', doj = '{$date}', updateDate = '{$upDate}' WHERE id = '{$staffId}'";

$result = mysqli_query($conn, $sql) or die("query failed");

if ($result) {
    header("Location: {$domain}/admin/staff-details.php");
}

mysqli_close($conn);
