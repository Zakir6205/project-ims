<?php
date_default_timezone_set("Asia/Kolkata");
require_once 'config.php';

$nameErr = $fnameErr = $mnameErr = $dobErr = $genderErr = $adharErr = $svErr = $cnameErr = $dnameErr = $snameErr = $conameErr = $pcodeErr = $phoneErr = $aphoneErr = $emailErr = $ctyErr = $courNameErr = $payAmtErr = $payMethErr = $imgErr = $passErr = $cpassErr = "";

$stuName = $stufName = $stumName = $stuDob = $stuGender = $stastuAdharffAdhar = $stusvName = $stucName = $studName = $stusName = $stucoName = $stupCode = $stuPhone = $stuaPhone = $stuEmail = $courseType = $courseNameId = $courseFee = $coursepAmt = $payMeth =  $stuPassword = $stucPassword = "";

if (isset($_GET['id'])) {
    $enqId = $_GET['id'];
    $enq = "SELECT eStuName, enqPhoneNo FROM enquiry WHERE enqId = '{$enqId}'";
    $resenq = mysqli_query($conn, $enq) or die("error");
    if (mysqli_num_rows($resenq) > 0) {
        while ($denq = mysqli_fetch_assoc($resenq)) {
            $stuName = $denq['eStuName'];
            $stuPhone = $denq['enqPhoneNo'];
        }
    } else {
        echo "error";
    }
} else {
    $stuName = "";
    $stuPhone = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['stuName'])) {
        $nameErr = "*Name is required";
    } else {
        $stuName = input_data($_POST['stuName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stuName)) {
            $nameErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['stu-fName'])) {
        $fnameErr = "*Father's Name is required";
    } else {
        $stufName = input_data($_POST['stu-fName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stufName)) {
            $fnameErr = "*Enter Valid Name";
        }
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $_POST['stu-mName'])) {
        $mnameErr = "*Enter Valid Name";
    } else {
        $stumName = input_data($_POST['stu-mName']);
    }

    if (empty($_POST['stuDob'])) {
        $dobErr = "*Dob is required";
    } else {
        $stuDob = input_data($_POST['stuDob']);
    }

    if (empty($_POST['stuGender'])) {
        $genderErr = "*Gender is required";
    } else {
        $stuGender = input_data($_POST['stuGender']);
    }

    if (empty($_POST['stuAdhar'])) {
        $adharErr = "*Adhar No. is required";
    } else {
        $stuAdhar = input_data($_POST['stuAdhar']);
        if (!preg_match("/^[0-9]*$/", $stuAdhar)) {
            $adharErr = "Enter Valid Adhar Number";
        }
        if (strlen($stuAdhar) != 12) {
            $adharErr = "Adhar No. contain 12 digit";
        }
    }

    if (empty($_POST['stu-svName'])) {
        $svErr = "*This Field is required";
    } else {
        $stusvName = input_data($_POST['stu-svName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stusvName)) {
            $svErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['stu-cName'])) {
        $cnameErr = "*City is required";
    } else {
        $stucName = input_data($_POST['stu-cName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stucName)) {
            $cnameErr = "*Enter Valid City Name";
        }
    }

    if (empty($_POST['stu-dName'])) {
        $dnameErr = "*District is required";
    } else {
        $studName = input_data($_POST['stu-dName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $studName)) {
            $dnameErr = "*Enter Valid District Name";
        }
    }

    if (empty($_POST['stu-sName'])) {
        $snameErr = "*State is required";
    } else {
        $stusName = input_data($_POST['stu-sName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stusName)) {
            $snameErr = "*Enter Valid State Name";
        }
    }

    if (empty($_POST['stu-coName'])) {
        $conameErr = "*Country is required";
    } else {
        $stucoName = input_data($_POST['stu-coName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $stucoName)) {
            $conameErr = "*Enter Valid Country Name";
        }
    }

    if (empty($_POST['stu-pCode'])) {
        $pcodeErr = "*Pin Code is required";
    } else {
        $stupCode = input_data($_POST['stu-pCode']);
        if (!preg_match("/^[0-9]*$/", $stupCode)) {
            $pcodeErr = "Enter Valid Pin Code";
        }
        if (strlen($stupCode) != 6) {
            $pcodeErr = "Pin Code contain 6 digit";
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

    if (empty($_POST['stuAphone'])) {
        $aphoneErr = "";
    } elseif (!preg_match("/^[0-9]*$/", $_POST['stuAphone'])) {
        $aphoneErr = "Enter Valid Phone Number";
    } elseif (strlen($_POST['stuAphone']) != 10) {
        $aphoneErr = "Phone No. contain 10 digit";
    } else {
        $stuaPhone = input_data($_POST['stuAphone']);
    }

    if (empty($_POST['stuEmail'])) {
        $emailErr = "*Email is required";
    } else {
        $stuEmail = input_data($_POST['stuEmail']);
        if (!filter_var($stuEmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Enter Valid Email";
        }
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

    if (empty($_POST['stuPassword'])) {
        $passErr =  "*Enter Password";
    } else {
        $stuPassword = htmlspecialchars($_POST['stuPassword']);
    }

    if (empty($_POST['stuCpassword'])) {
        $cpassErr = "*Enter Confirm Password";
    } else {
        $stucPassword = htmlspecialchars($_POST['stuCpassword']);
    }

    if ($stuPassword != $stucPassword) {
        $cpassErr = "Password doesn't match";
    }

    if ($_FILES['stu-image']['name'] == "") {
        $imgErr = "*Please Upload Image";
    }

    if ($nameErr === "" and $fnameErr === "" and $mnameErr === "" and $dobErr === "" and $genderErr === "" and $adharErr === "" and $svErr === "" and $cnameErr === "" and $dnameErr === "" and $snameErr === "" and $conameErr === "" and $pcodeErr === "" and $phoneErr === "" and $aphoneErr === "" and $emailErr === "" and $ctyErr === "" and $courNameErr === "" and $payAmtErr === "" and $payMethErr === "" and $imgErr === "" and $passErr === "" and $cpassErr === "") {
        $date = date("Y-m-d");
        $upDate = date("Y-m-d");
        $stuUserName =  $stuEmail;

        if (isset($_FILES['stu-image'])) {
            $fileName = $_FILES['stu-image']['name'];
            $fileSize = $_FILES['stu-image']['size'];
            $fileTmp = $_FILES['stu-image']['tmp_name'];
            $fileType = $_FILES['stu-image']['type'];
            $fileErr = $_FILES['stu-image']['error'];

            $file_ext = explode('.', $fileName);
            $file_ext_chect = strtolower(end($file_ext));
            $valid_ext = ['png', 'jpg', 'jpeg'];
            if (!in_array($file_ext_chect, $valid_ext)) {
                $imgErr = "*Only png, jpg, jpeg allowed";
            } elseif ($fileSize <= 25000) {
                move_uploaded_file($fileTmp, "studentuploadedimg/" . $fileName);
            } else {
                $imgErr = "*Maximum Size - 25kb allowed";
            }
        }

        if ($imgErr === "") {
            $sql = "INSERT INTO studentDetails(stuName, fatherName, motherName, dob, gender, adharNo, svName,cityName, distName, stateName, countryName, pinCode, phoneNo, aPhoneNo, email, doe, stuImgName, username, password, updateDate) VALUES ('{$stuName}', '{$stufName}', '{$stumName}', '{$stuDob}', '{$stuGender}', '{$stuAdhar}', '{$stusvName}', '{$stucName}', '{$studName}', '{$stusName}', '{$stucoName}', '{$stupCode}', '{$stuPhone}', '{$stuaPhone}', '{$stuEmail}','{$date}', '{$fileName}', '{$stuUserName}', md5('{$stuPassword}'), '{$upDate}')";

            $result = mysqli_query($conn, $sql) or die("query failed");

            if ($result) {
                $last_id = mysqli_insert_id($conn);
                if ($last_id) {
                    $code = "00";
                    $stuId = "EDXST" . $code . $last_id;
                    $query = "UPDATE studentDetails SET stuId = '{$stuId}' WHERE id = '{$last_id}' ";
                    $result = mysqli_query($conn, $query);
                }

                $tranId = htmlspecialchars($_POST['tranId']);
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

                $sql2 = "SELECT id FROM studentDetails WHERE stuId = '{$stuId}'";
                $result2 = mysqli_query($conn, $sql2) or die("query failed");

                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $studentId = $row['id'];
                    }
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
                }
                if ($result3 == true and $result4 == true) {
                    header("Location: {$domain}/staff/success-page.php?sid={$studentId}&cid={$courseId}&inv={$invNo}");
                    mysqli_close($conn);
                } else {
                    echo "something went wrong";
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
    <title>Student Enrollment</title>
    <style>
        .registration-form .input-box .rel #errmat {
            font-size: 12px;
            color: red;
            padding-left: 10px;
        }
    </style>
</head>

<body>

    <head>
        <?php include 'staff-nav.php' ?>
    </head>
    <main>
        <?php include 'staff-menu.php' ?>

        <div class="right-con">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="registration-form">
                    <div class="tsr">
                        <h3>Student Enrollment Form</h3>
                    </div>
                    <div class="input-tittle">Personal Details : </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="stuName">Student Full Name </label>
                            <input class="ibm" type="text" name="stuName" id="stuName" value="<?php echo $stuName; ?>" autocomplete="off">
                            <span><?php echo $nameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-fName">Father's Name </label>
                            <input class="ibm" type="text" name="stu-fName" id="stu-fName" value="<?php echo $stufName; ?>" autocomplete="off">
                            <span><?php echo $fnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-mName">Mother Name(optional) </label>
                            <input class="ibm" type="text" name="stu-mName" id="stu-mName" value="<?php echo $stumName; ?>" autocomplete="off">
                            <span><?php echo $mnameErr; ?></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="stuDob">Date of Birth </label>
                            <input type="date" name="stuDob" id="stuDob" value="<?php echo $stuDob; ?>" autocomplete="off">
                            <span><?php echo $dobErr; ?></span>
                        </div>
                        <div class="input">
                            <label for="stuGender">Select Gender </label>
                            <select name="stuGender" id="stuGender">
                                <option selected disabled value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span><?php echo $genderErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stuAdhar">Adhar Number </label>
                            <input type="number" name="stuAdhar" id="stuAdhar" value="<?php echo $stuAdhar; ?>" autocomplete="off">
                            <span><?php echo $adharErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Address Details : </div>
                    <div class="input-box ">
                        <div class="input">
                            <label for="stu-svName">Street/Village Name </label>
                            <input class="ibm" type="text" name="stu-svName" id="stu-svName" value="<?php echo $stusvName; ?>" autocomplete="off">
                            <span><?php echo $svErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-cName">City Name </label>
                            <input class="ibm" type="text" name="stu-cName" id="stu-cName" value="<?php echo $stucName; ?>" autocomplete="off">
                            <span><?php echo $cnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-dName">District Name </label>
                            <input class="ibm" type="text" name="stu-dName" id="stu-dName" value="<?php echo $studName; ?>" autocomplete="off">
                            <span><?php echo $dnameErr; ?></span>
                        </div>
                    </div>

                    <div class="input-box">
                        <div class="input">
                            <label for="stu-sName">State Name </label>
                            <input type="text" name="stu-sName" id="stu-sName" value="<?php echo $stusName; ?>" autocomplete="off">
                            <span><?php echo $snameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-cName">Country Name </label>
                            <input type="text" name="stu-coName" id="stu-coName" value="<?php echo $stucoName; ?>" autocomplete="off">
                            <span><?php echo $conameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stu-pCode">Pin Code </label>
                            <input type="number" name="stu-pCode" id="stu-pCode" value="<?php echo $stupCode; ?>" autocomplete="off">
                            <span><?php echo $pcodeErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Contact Details : </div>
                    <div class="input-box  ">
                        <div class="input">
                            <label for="stuPhone">Phone Number </label>
                            <input type="number" name="stuPhone" id="stuPhone" value="<?php echo $stuPhone; ?>" autocomplete="off">
                            <span><?php echo $phoneErr; ?></span>
                        </div>

                        <div class="input" style="position:relative;">
                            <label for="stuAphone">Phone Number2(Optional) </label>
                            <input type="number" name="stuAphone" id="stuAphone" value="<?php echo $stuaPhone; ?>" autocomplete="off">
                            <span><?php echo $aphoneErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="stuEmail">Email Address</label>
                            <input type="text" name="stuEmail" id="stuEmail" value="<?php echo $stuEmail; ?>" autocomplete="off">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Upload Image( Only png, jpg, jpeg allowed. Max - 25kb) : </div>
                    <div class="input-box ">
                        <div class="input iptd">
                            <input style="border: none;" type="file" name="stu-image" id="stu-image" accept=".png, .jpg, .jpeg">
                            <span><?php echo $imgErr; ?></span>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Course Details : </div>
                    <div class="input-box">
                        <div class="input">
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
                                <input readonly name="courseFee" type='text' id='courseFee'>
                            </div>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Payment Details : </div>
                    <div class="input-box  ">
                        <div class="input">
                            <label for="stu-pAmt">Paid by Student(in rupees) </label>
                            <input style="margin-top: 3px;" type="number" name="stu-pAmt" id="stu-pAmt">
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
                    <div class="input-tittle ibt non1">Create Password : </div>
                    <div class="input-box non2">
                        <div class="input ip4 rel ">
                            <label for="stuPassword">Password </label>
                            <div class="maint">
                                <input type="password" name="stuPassword" id="stuPassword" value="<?php echo $stuPassword; ?>" autocomplete="off">
                                <span><img src="image/eye.svg" alt="eye" id="eye1"></span>
                                <span><img src="image/offeye.svg" alt="offeye" id="offeye1"></span>
                            </div>
                            <span><?php echo $passErr; ?></span>
                        </div>
                        <div class="input ip4 rel ">
                            <label for="stuCpassword">Confirm Password </label>
                            <div class="maint">
                                <input type="password" name="stuCpassword" id="stuCpassword" value="<?php echo $stucPassword; ?>" autocomplete="off">
                                <span><img src="image/eye.svg" alt="eye" id="eye2"></span>
                                <span><img src="image/offeye.svg" alt="offeye" id="offeye2"></span>
                            </div>
                            <span><?php echo $cpassErr; ?></span>
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
    <script>
        let pass1 = document.querySelector("#stuPassword");
        let pass2 = document.querySelector("#stuCpassword");
        let eye1 = document.querySelector("#eye1");
        let eye2 = document.querySelector("#eye2");
        let offeye1 = document.querySelector("#offeye1");
        let offeye2 = document.querySelector("#offeye2");

        offeye1.addEventListener("click", () => {
            offeye1.style.display = "none";
            eye1.style.display = "inline";
            pass1.setAttribute("type", "text");
        })

        eye1.addEventListener("click", () => {
            eye1.style.display = "none";
            offeye1.style.display = "inline";
            pass1.setAttribute("type", "password");
        })

        offeye2.addEventListener("click", () => {
            offeye2.style.display = "none";
            eye2.style.display = "inline";
            pass2.setAttribute("type", "text");
        })
        eye2.addEventListener("click", () => {
            eye2.style.display = "none";
            offeye2.style.display = "inline";
            pass2.setAttribute("type", "password");
        })
    </script>
</body>

</html>