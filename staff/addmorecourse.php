<?php
date_default_timezone_set("Asia/Kolkata");
require_once 'config.php';

$ctyErr = $courNameErr = $payAmtErr = $payMethErr = "";
$courseType = $courseNameId = $courseFee = $coursepAmt = $payMeth =  "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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

    $courseFee = $_POST['courseFee'];

    if (empty($_POST['stu-pAmt'])) {
        $payAmtErr = "*Paid Amount required";
    } elseif ($_POST['stu-pAmt'] > $courseFee) {
        $payAmtErr = "*Amount not be greater than fee";
    } elseif ($_POST['stu-pAmt'] < 0) {
        $payAmtErr = "*Enter Valid Amount";
    } else {
        $coursepAmt = input_data($_POST['stu-pAmt']);
    }

    if (empty($_POST['payMeth'])) {
        $payMethErr = "*Select Payment Method";
    } else {
        $payMeth = input_data($_POST['payMeth']);
    }

    if ($ctyErr === "" and $courNameErr === "" and $payAmtErr === "" and $payMethErr === "") {
        $studentId = $_POST['stuId'];
        $tranId = htmlspecialchars($_POST['tranId']);
        date_default_timezone_set("Asia/Kolkata");
        $dateOfIn = date("Y-m-d");

        $query = "SELECT id, courseName, courseFee, courseStartDate, courseDuration FROM courseDetails WHERE courseId = '{$courseNameId}' and courseTy = '{$courseType}'";
        $res = mysqli_query($conn, $query) or die("query failed");
        if (mysqli_num_rows($res) > 0) {
            while ($data = mysqli_fetch_assoc($res)) {
                $courseId = $data['id'];
                $courseName = $data['courseName'];
                $courseFee = $data['courseFee'];
                $courseStDate = $data['courseStartDate'];
                $courseDur = $data['courseDuration'];
            }

            $monthofdue = ceil($courseDur / 2);

            number_format($courseFee);
            $feeDue = $courseFee - $coursepAmt;

            $dt = date_create($courseStDate);
            date_modify($dt, "+{$monthofdue} month");

            $dueDate =  date_format($dt, "Y-m-d");
        }

        if ($res == true) {

            $sql3 = "INSERT INTO studentCourseDetails(studentId, courId, stuPAmt, Feedue, dueDate, dateOfIn) VALUES ( '{$studentId}','{$courseId}','{$coursepAmt}', '{$feeDue}','{$dueDate}', '{$dateOfIn}' ) ";

            $sql4 = "INSERT INTO studentPaymentDetails(studentId, courId, payAmt, payMeth, tranId, payDate) VALUES ('{$studentId}','{$courseId}','{$coursepAmt}','{$payMeth}','{$tranId}','{$dateOfIn}')";

            $result3 = mysqli_query($conn, $sql3) or die("query failed");

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

            if ($result3 == true and $result4 == true) {
                header("Location: {$domain}/staff/success-page.php?sid={$studentId}&cid={$courseId}&inv={$invNo}");
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
    <title>add more course</title>
</head>

<body>

    <header>
        <?php require_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php require_once 'staff-menu.php';
        $stuId = $_GET['id'];
        require_once 'config.php';
        $query = "SELECT id, stuName FROM studentDetails WHERE stuId = '{$stuId}'";
        $res = mysqli_query($conn, $query) or die("error");
        if (mysqli_num_rows($res) > 0) {
            while ($data = mysqli_fetch_assoc($res)) {
                $stuName = $data['stuName'];
                $studentId = $data['id'];
            }
        }
        ?>
        <div class="right-con">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $stuId; ?>" method="post" enctype="multipart/form-data">
                <div id="newform" class="registration-form">
                    <div class="tsr">
                        <h3>Student Enrollment Form</h3>
                    </div>
                    <div class="studt">
                        <input type="hidden" name="stuId" value="<?php echo $studentId; ?>">
                        <p class="sid">Id - <?php echo $stuId; ?></p>
                        <p class="snam">Student Name- <?php echo $stuName; ?></p>
                    </div>
                    <div class="input-tittle ibt">Course Details : </div>
                    <div class="input-box">
                        <div class="input">
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
                        <div class="input">
                            <label for="courseName">Course Name </label>
                            <select style="margin-top: 3px;" name="courseName" id="courseName">
                                <option selected disabled value="">Select Course</option>
                            </select>
                            <span><?php echo $courNameErr; ?></span>
                        </div>
                        <div class="input">
                            <div id="courseFee">
                                <label for='courseFee'>Course Fee(in rupees) </label>
                                <input readonly type='text' name="courseFee" id='courseFee'>
                            </div>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Payment Details : </div>
                    <div class="input-box  ">
                        <div class="input">
                            <label for="stu-pAmt">Paid by Student(in rupees) </label>
                            <input style="margin-top: 3px;" type="number" name="stu-pAmt" id="stu-pAmt" value="<?php echo $coursepAmt; ?>">
                            <span><?php echo $payAmtErr; ?></span>
                        </div>
                        <div class="input">
                            <label for="stu-pAmt">Payment Method </label>
                            <select style="margin-top: 3px;" name="payMeth" id="payMeth">
                                <option selected disabled value="">Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="UPI">UPI</option>
                                <option value="Net Banking">Net Banking</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                            <span><?php echo $payMethErr; ?></span>
                        </div>
                        <div class="input">
                            <div id="tranId">
                                <label for='tranId'>Transaction Id </label>
                                <input readonly name='tranId' id='tranId' type='text'>
                            </div>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <input type="submit" name="save" id="save">
                    </div>
                </div>

            </form>
        </div>


    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="queryy.js"></script>
</body>

</html>