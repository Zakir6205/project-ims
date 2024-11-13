<?php

if (isset($_POST['add-course'])) {

    $courseTittle = $_POST['coursetittle'];
    $courseName = $_POST['coursename'];
    $courseFee = $_POST['coursefee'];
    $courseDur = $_POST['coursedur'];
    $courseType = $_POST['coursetype'];
    $courseLang = $_POST['courselang'];
    $courseDesc = $_POST['coursedis'];

    date_default_timezone_set("Asia/Kolkata");

    $date = date("Y-m-d");
    $updateDate = date("Y-m-d");

    $stDateCr = date_create($_POST['course-st-date']);
    $courseStDate = date_format($stDateCr, "Y-m-d");


    include 'config.php';

    $sql = "INSERT INTO courseDetails(courseTittle, courseName, courseFee, courseDuration, courseTy, courseLang, courseDesc, courseDate, courseStartDate,  updateDate) VALUES('{$courseTittle}','{$courseName}','{$courseFee}','{$courseDur}','{$courseType}','{$courseLang}','{$courseDesc}','{$date}','{$courseStDate}','{$updateDate}')";

    $result = mysqli_query($conn, $sql) or die("query failed");

    if ($result) {
        $last_id = mysqli_insert_id($conn);
        if ($last_id) {
            $code = "00";
            $courseId = "EDXC" . $code . $last_id;
            $query = "UPDATE courseDetails SET courseId = '{$courseId}' WHERE id = '{$last_id}' ";
            $result = mysqli_query($conn, $query);
        }

        if ($courseType == "Entrance") {
            header("Location: {$domain}/admin/coursed-entrance.php");
        } elseif ($courseType == "CS & IT") {
            header("Location: {$domain}/admin/coursed-csIt.php");
        } elseif ($courseType == "Boards") {
            header("Location: {$domain}/admin/coursed-boards.php");
        } elseif ($courseType == "Competitive-Exams") {
            header("Location: {$domain}/admin/coursed-competitive.php");
        } else {
            header("Location: {$domain}/admin/coursedetails.php");
        }
    }

    mysqli_close($conn);
}
