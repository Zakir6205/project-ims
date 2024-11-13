<?php

date_default_timezone_set("Asia/Kolkata");

if (isset($_POST['submit'])) {

    $stupamtc = $_POST['stupamtc'];

    $stuId = $_POST['sid'];
    $courId = $_POST['cid'];
    $stupamtp = $_POST['stupamtp'];
    $duefeep = $_POST['duefeep'];
    $courfee = $_POST['courfee'];
    $payMeth = $_POST['payMeth'];
    $tranId = $_POST['tranId'];
    $payDate = date("Y-m-d");

    $dueDate = "";

    $stutotalpaid = $stupamtc + $stupamtp;
    $stufeedue = $courfee - $stutotalpaid;

    $dueDate = $_POST['duedate'];

    include_once 'config.php';
    $sql = "UPDATE studentCourseDetails SET stuPAmt = '{$stutotalpaid}', Feedue = '{$stufeedue}', dueDate = '{$dueDate}' WHERE studentId = '{$stuId}' and courId = '{$courId}' ";

    $sql4 = "INSERT INTO studentPaymentDetails(studentId, courId, payAmt, payMeth, tranId, payDate) VALUES ('{$stuId}','{$courId}','{$stupamtc}','{$payMeth}','{$tranId}','{$payDate}')";

    $result = mysqli_query($conn, $sql) or die("query failed");

    $result4 = mysqli_query($conn, $sql4) or die("error");

    if ($result4) {
        $last_id2 = mysqli_insert_id($conn);
        if ($last_id2) {
            $code2 = "00";
            $invNo = "INV" . $code2 . $last_id2;
            $query2 = "UPDATE studentPaymentDetails SET invNo = '{$invNo}' WHERE id = '{$last_id2}' ";
            $result = mysqli_query($conn, $query2);
        }
    }

    if ($result == true and $result4 == true) {
        header("Location: {$domain}/staff/updatepaysucc.php?sid={$stuId}&cid={$courId}&inv={$invNo}");
    } else {
        echo "Something Went wrong";
    }
}
