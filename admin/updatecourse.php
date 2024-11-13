<?php

if (isset($_POST['update-course'])) {
    $courseId = $_POST['courseId'];
    $courseTittle = $_POST['coursetittle'];
    $courseName = $_POST['coursename'];
    $courseFee = $_POST['coursefee'];
    $courseDur = $_POST['coursedur'];
    $courseType = $_POST['coursetype'];
    $courseLang = $_POST['courselang'];
    $courseDesc = $_POST['coursedis'];
    $courseAddedDate = $_POST['courseAddedDate'];

    date_default_timezone_set("Asia/Kolkata");

    $updateDate = date("Y-m-d");
    $stDateCr = date_create($_POST['course-st-date']);

    $courseStDate = date_format($stDateCr, "Y-m-d");

    include 'config.php';

    $sql = "UPDATE courseDetails SET courseTittle = '{$courseTittle}', courseName = '{$courseName}',courseFee = '{$courseFee}',  courseDuration = '{$courseDur}', courseTy = '{$courseType}',courseLang = '{$courseLang}',courseDesc = '{$courseDesc}',courseDate = '{$courseAddedDate}', courseStartDate = '{$courseStDate}', updateDate = '{$updateDate}'  WHERE courseId = '{$courseId}'";

    $result = mysqli_query($conn, $sql) or die("query failed");


    if ($result) {
        header("Location: {$domain}/admin/coursedetails.php");
    }

    mysqli_close($conn);
}
