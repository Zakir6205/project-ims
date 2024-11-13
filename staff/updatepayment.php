<?php
date_default_timezone_set("Asia/Kolkata");
$payAmtErr = $payMethErr = "";
$stupamtc = $payMeth = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $duefeep = $_POST['duefeep'];

    if (empty($_POST['stupamtc'])) {
        $payAmtErr = "*Paid Amount required";
    } elseif ($_POST['stupamtc'] > $duefeep) {
        $payAmtErr = "*Amount not be greater than due";
    } elseif ($_POST['stupamtc'] < 0) {
        $payAmtErr = "*Enter Valid Amount";
    } else {
        $stupamtc = $_POST['stupamtc'];
    }

    if (empty($_POST['payMeth'])) {
        $payMethErr = "*Select Payment Method";
    } else {
        $payMeth = input_data($_POST['payMeth']);
    }

    if ($payAmtErr === "" and $payMethErr === "") {
        $stuId = $_POST['sid'];
        $courId = $_POST['cid'];
        $stupamtp = $_POST['stupamtp'];
        $courfee = $_POST['courfee'];
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
    <title>update payment</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>

    </header>
    <main>
        <?php include 'staff-menu.php' ?>
        <div class="update-pay">
            <?php
            $stuId = $_GET['sid'];
            $courId = $_GET['cid'];
            include_once 'config.php';
            $sql = "SELECT stuName, courseName, Feedue, stuPAmt, courseFee, dueDate FROM studentcoursedetails s inner join studentdetails a on s.studentId = a.id inner join coursedetails c on s.courId = c.id WHERE studentId = '{$stuId}' and courId = '{$courId}'";
            $result = mysqli_query($conn, $sql) or die("query failed");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <form class="updatepayform registration-form" action="<?php echo $_SERVER['PHP_SELF'] ?>?cid=<?php echo $courId ?>&sid=<?php echo $stuId ?>" method="post">
                        <div class="stu-dett">
                            <p class="sname">Student Name - <?php echo $row['stuName'] ?></p>
                            <p class="cname">Course Name - <?php echo $row['courseName'] ?></p>
                        </div>
                        <div class="due">
                            Total Due Amount - ₹ <?php echo $row['Feedue'] ?>
                        </div>
                        <div class="formm">
                            <input type="hidden" name="sid" value='<?php echo $stuId ?>'>
                            <input type="hidden" name="cid" value="<?php echo $courId ?>">
                            <input type="hidden" name="stupamtp" value="<?php echo $row['stuPAmt'] ?>">
                            <input type="hidden" name="courfee" value="<?php echo $row['courseFee'] ?>">
                            <input type="hidden" name="duefeep" value="<?php echo $row['Feedue'] ?>">
                            <input type="hidden" name="duedate" value="<?php echo $row['dueDate'] ?>">
                        </div>
                <?php      }
            }
                ?>
                <div class="input-box  ">
                    <div class="input">
                        <label for="stupay">Paid by Student(in rupees) </label>
                        <input style="margin-top: 3px;" type="number" name="stupamtc" id="stupay">
                        <span><?php echo $payAmtErr; ?></span>
                    </div>
                    <div class="input">
                        <label for="payMeth">Payment Method </label>
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
                            <input readonly type='text' name='tranId' id='tranId'>
                        </div>
                    </div>
                </div>
                <div class="cent">
                    <button type="submit" class="upd" name="submit">₹ Pay</button>
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