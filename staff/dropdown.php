<?php

include 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT courseId, courseName FROM courseDetails WHERE courseTy = '$id' ORDER BY id DESC ";
    $result = mysqli_query($conn, $sql) or die("query failed");

    if (mysqli_num_rows($result) > 0) {
        echo "<option selected disabled >Select Course</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['courseName'];
            $courseId = $row['courseId'];
            echo " <option value = '$courseId' > $name </option> ";
        }
    }
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $sql = "SELECT courseFee FROM courseDetails WHERE courseId = '$name' ";
    $result = mysqli_query($conn, $sql) or die("query failed");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fee = $row['courseFee'];
            echo " <label for='courseFee'>Course Fee(in rupees) </label>";
            echo "<input readonly name='courseFee' type='text' id='courseFee' value='$fee'>";
        }
    }
}

if (isset($_POST['meth'])) {
    $meth = $_POST['meth'];
    if ($meth != "Cash" && $meth != "Cheque") {
        echo " <label for='tranId'>Transaction id </label>";
        echo "<input name='tranId' id='tranId' type='text' required>";
    } elseif ($meth == "Cheque") {
        echo " <label for='tranId'>Cheque Number </label>";
        echo "<input name='tranId' id='tranId' type='text' required>";
    } elseif ($meth == "Cash") {
        echo " <label for='tranId'>Transaction id </label>";
        echo "<input readonly name='tranId' id='tranId' type='text'>";
    }
}
