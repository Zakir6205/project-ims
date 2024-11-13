<?php
$Id = $_POST['id'];
$Name = $_POST['Name'];
$fName = $_POST['fName'];
$mName = $_POST['mName'];
$Dob = $_POST['Dob'];
$Gender = $_POST['Gender'];
$Adhar = $_POST['Adhar'];
$SVName = $_POST['svName'];
$CName = $_POST['cName'];
$DName = $_POST['dName'];
$SName = $_POST['sName'];
$CoName = $_POST['coName'];
$PCode = $_POST['pCode'];
$Phone = $_POST['Phone'];
$Aphone = $_POST['Aphone'];
$Email = $_POST['Email'];
$date = $_POST['addedDate'];
date_default_timezone_set("Asia/Kolkata");
$upDate = date("Y-m-d");

include_once 'config.php';

$sql = "UPDATE teacherDetails SET teacherName = '{$Name}', fatherName = '{$fName}',motherName = '{$mName}',dob = '{$Dob}',gender = '{$Gender}',adharNo = '{$Adhar}',svName = '{$SVName}',cityName = '{$CName}',distName = '{$DName}',stateName = '{$SName}',countryName = '{$CoName}',pinCode = '{$PCode}',phoneNo = '{$Phone}',aPhoneNo = '{$Aphone}',email = '{$Email}', doj = '{$date}', updateDate = '{$upDate}' WHERE id = '{$Id}'";

$result = mysqli_query($conn, $sql) or die("query failed");

if ($result) {
    header("Location: {$domain}/admin/teacher-details.php");
}

mysqli_close($conn);
