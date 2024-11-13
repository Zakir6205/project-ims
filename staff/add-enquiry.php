<?php
date_default_timezone_set("Asia/Kolkata");
require_once 'config.php';

$nameErr = $phoneErr = $emailErr = $ctyErr = $courNameErr = "";
$stuName = $stuPhone = $stuEmail = $courseType = $courseNameId = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['stuName'])) {
        $nameErr = "*Name is required";
    } else {
        $stuName = input_data($_POST['stuName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stuName)) {
            $nameErr = "*Enter Valid Name";
        }
    }
    if (empty($_POST['stuPhone'])) {
        $phoneErr = "*Phone No. is required";
    } else {
        $stuPhone = input_data($_POST['stuPhone']);
        if (!preg_match("/^[0-9]*$/", $stuPhone)) {
            $phoneErr = "Enter Valid Phone Number";
        }
        if (strlen($stuPhone) != 10) {
            $phoneErr = "Phone No. contain 10 digit";
        }
    }

    if (empty($_POST['stuEmail'])) {
        $emailErr = "";
    } elseif (!filter_var($_POST['stuEmail'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "*Enter Valid Email";
    } else {
        $stuEmail = input_data($_POST['stuEmail']);
    }

    if (empty($_POST['courseType'])) {
        $ctyErr = "*Select Course Type";
    } else {
        $courseType = input_data($_POST['courseType']);
    }

    if (empty($_POST['courseName'])) {
        $courNameErr = "*Select Course";
    } else {
        $courseNameId = input_data($_POST['courseName']);
    }
    if ($nameErr === "" and $phoneErr === "" and $emailErr === "" and $ctyErr === "" and $courNameErr === "") {
        $date = date("Y-m-d");
        $addBy = $_POST['staffId'];

        $sql6 = "SELECT id FROM courseDetails WHERE courseId = '{$courseNameId}' and courseTy = '{$courseType}'";
        $result6 = mysqli_query($conn, $sql6) or die("error");
        if (mysqli_num_rows($result6) > 0) {
            while ($row6 = mysqli_fetch_assoc($result6)) {
                $courId = $row6['id'];
            }
        }

        $sql5 = "INSERT INTO enquiry(eStuName, enqPhoneNo, eEmail, eCourId, enqDate, addBy) VALUES ('{$stuName}','{$stuPhone}','{$stuEmail}','{$courId}','{$date}','{$addBy}')";
        $result5 = mysqli_query($conn, $sql5) or die("error");

        if ($result5 == true) {
            $last_id = mysqli_insert_id($conn);
            if ($last_id) {
                $code = "00";
                $enqId = "ENQ" . $code . $last_id;
                $query7 = "UPDATE enquiry SET enqId = '{$enqId}' WHERE eid = '{$last_id}' ";
                $result7 = mysqli_query($conn, $query7) or die("error");
                if($result7 = true){
                    header("Location: {$domain}/staff/enquiry-details.php");
                }
            }
        }
    }
}
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <?php require_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php require_once 'staff-menu.php' ?>
        <div class="right-con">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div style="height: 100%; padding-bottom:25px; margin-top:35px;" class="registration-form">
                    <div class="tsr">
                        <h3>Enquiry Form</h3>
                    </div>
                    <div class="input-tittle">Personal Details : </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="stuName">Student Full Name </label>
                            <input type="hidden" name="staffId" value="<?php echo $_SESSION['staffId']; ?>">
                            <input class="ibm" type="text" name="stuName" id="stuName" value="<?php echo $stuName; ?>" autocomplete="off">
                            <span><?php echo $nameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stuPhone">Phone Number </label>
                            <input type="number" name="stuPhone" id="stuPhone" value="<?php echo $stuPhone; ?>" autocomplete="off">
                            <span><?php echo $phoneErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stuEmail">Email Address(optional)</label>
                            <input type="text" name="stuEmail" id="stuEmail" value="<?php echo $stuEmail; ?>" autocomplete="off">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Enquiry For : </div>
                    <div class="input-box">
                        <div class="input inpt2">
                            <input type="hidden" name="courid" value="<?php echo $row['id'] ?>">
                            <label for="courseType">Course Type </label>
                            <select style="margin-top: 3px;" name="courseType" id="courseType">
                                <option selected disabled value="">Select Type</option>
                                <?php
                                include 'config.php';
                                $sql = "SELECT * FROM courseType";
                                $result = mysqli_query($conn, $sql) or die("query failed");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['ctId'] ?>"><?php echo $row['ctName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span><?php echo $ctyErr; ?></span>
                        </div>
                        <div class="input inpt2">
                            <label for="courseName">Course Name </label>
                            <select style="margin-top: 3px;" name="courseName" id="courseName">
                                <option selected disabled value="">Select Course</option>
                            </select>
                            <span><?php echo $courNameErr; ?></span>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <input type="submit" name="save" id="save" value="Submit">
                    </div>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once '../admin/footer.php' ?>
    </footer>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="queryy.js"></script>
</body>

</html>