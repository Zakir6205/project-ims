<?php
require_once 'sessioninactive.php';

$nameErr = $fnameErr = $mnameErr = $dobErr = $genderErr = $adharErr = $svErr = $cnameErr = $dnameErr = $snameErr = $conameErr = $pcodeErr = $phoneErr = $aphoneErr = $emailErr = $imgErr = "";

$staffName = $fName = $mName = $staffDob = $staffGender = $staffAdhar = $staffSVName = $staffCName = $staffDName = $staffSName = $staffCoName = $staffPCode = $staffPhone = $staffAphone = $staffEmail = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['staffName'])) {
        $nameErr = "*Name is required";
    } else {
        $staffName = input_data($_POST['staffName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffName)) {
            $nameErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['staff-fName'])) {
        $fnameErr = "*Father's Name is required";
    } else {
        $fName = input_data($_POST['staff-fName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $fName)) {
            $fnameErr = "*Enter Valid Name";
        }
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $_POST['staff-mName'])) {
        $mnameErr = "*Enter Valid Name";
    } else {
        $mName = input_data($_POST['staff-mName']);
    }

    if (empty($_POST['staffDob'])) {
        $dobErr = "*Dob is required";
    } else {
        $staffDob = input_data($_POST['staffDob']);
    }
    if (empty($_POST['staffGender'])) {
        $genderErr = "*Gender is required";
    } else {
        $staffGender = input_data($_POST['staffGender']);
    }

    if (empty($_POST['staffAdhar'])) {
        $adharErr = "*Adhar No. is required";
    } else {
        $staffAdhar = input_data($_POST['staffAdhar']);
        if (!preg_match("/^[0-9]*$/", $staffAdhar)) {
            $adharErr = "Enter Valid Adhar Number";
        }
        if (strlen($staffAdhar) != 12) {
            $adharErr = "Adhar No. contain 12 digit";
        }
    }

    if (empty($_POST['staff-svName'])) {
        $svErr = "*This Field is required";
    } else {
        $staffSVName = input_data($_POST['staff-svName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffSVName)) {
            $svErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['staff-cName'])) {
        $cnameErr = "*City is required";
    } else {
        $staffCName = input_data($_POST['staff-cName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffCName)) {
            $cnameErr = "*Enter Valid City Name";
        }
    }

    if (empty($_POST['staff-dName'])) {
        $dnameErr = "*District is required";
    } else {
        $staffDName = input_data($_POST['staff-dName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffDName)) {
            $dnameErr = "*Enter Valid District Name";
        }
    }

    if (empty($_POST['staff-sName'])) {
        $snameErr = "*State is required";
    } else {
        $staffSName = input_data($_POST['staff-sName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffSName)) {
            $snameErr = "*Enter Valid State Name";
        }
    }

    if (empty($_POST['staff-coName'])) {
        $conameErr = "*Country is required";
    } else {
        $staffCoName = input_data($_POST['staff-coName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $staffCoName)) {
            $conameErr = "*Enter Valid Country Name";
        }
    }

    if (empty($_POST['staff-pCode'])) {
        $pcodeErr = "*Pin Code is required";
    } else {
        $staffPCode = input_data($_POST['staff-pCode']);
        if (!preg_match("/^[0-9]*$/", $staffPCode)) {
            $pcodeErr = "Enter Valid Pin Code";
        }
        if (strlen($staffPCode) != 6) {
            $pcodeErr = "Pin Code contain 6 digit";
        }
    }

    if (empty($_POST['staffPhone'])) {
        $phoneErr = "*Phone No. is required";
    } else {
        $staffPhone = input_data($_POST['staffPhone']);
        if (!preg_match("/^[0-9]*$/", $staffPhone)) {
            $phoneErr = "Enter Valid Phone Number";
        }
        if (strlen($staffPhone) != 10) {
            $phoneErr = "Phone No. contain 10 digit";
        }
    }

    if (empty($_POST['staffAphone'])) {
        $aphoneErr = "";
    } elseif (!preg_match("/^[0-9]*$/", $_POST['staffAphone'])) {
        $aphoneErr = "Enter Valid Phone Number";
    } elseif (strlen($_POST['staffAphone']) != 10) {
        $aphoneErr = "Phone No. contain 10 digit";
    } else {
        $staffAphone = input_data($_POST['staffAphone']);
    }

    if (empty($_POST['staffEmail'])) {
        $emailErr = "";
    } elseif (!filter_var($_POST['staffEmail'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "*Enter Valid Email";
    } else {
        $staffEmail = input_data($_POST['staffEmail']);
    }

    if ($_FILES['st-image']['name'] == "") {
        $imgErr = "Please Upload Image";
    }


    if ($nameErr === "" and $fnameErr === "" and $mnameErr === "" and  $dobErr === "" and  $genderErr ===  "" and $adharErr === "" and  $svErr === "" and  $cnameErr === "" and  $dnameErr ===  "" and $snameErr === "" and  $conameErr ===  "" and $pcodeErr === "" and  $phoneErr ===  "" and $aphoneErr === "" and  $emailErr === "" and  $imgErr ===  "") {

        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d");
        $stType = $_POST['st-type'];
        $upDate = date("Y-m-d");

        if (isset($_FILES['st-image'])) {
            $fileName = $_FILES['st-image']['name'];
            $fileSize = $_FILES['st-image']['size'];
            $fileTmp = $_FILES['st-image']['tmp_name'];
            $fileType = $_FILES['st-image']['type'];
            $fileErr = $_FILES['st-image']['error'];

            $file_ext = explode('.', $fileName);
            $file_ext_chect = strtolower(end($file_ext));
            $valid_ext = ['png', 'jpg', 'jpeg'];
            if (!in_array($file_ext_chect, $valid_ext)) {
                $imgErr = "*Only png, jpg, jpeg allowed";
            } elseif ($fileSize <= 25000) {
                move_uploaded_file($fileTmp, "staffuploadedimg/" . $fileName);
            } else {
                $imgErr = "*Maximum Size - 25kb allowed";
            }
        }
        if ($imgErr === "") {
            include_once 'config.php';
            $sql = "INSERT INTO staffDetails(staffName, fatherName, motherName, dob, gender, adharNo, svName,cityName, distName, stateName, countryName, pinCode, phoneNo, aPhoneNo, email, stType, doj, stImgName, updateDate) VALUES ('{$staffName}', '{$fName}', '{$mName}', '{$staffDob}', '{$staffGender}', '{$staffAdhar}', '{$staffSVName}', '{$staffCName}', '{$staffDName}', '{$staffSName}', '{$staffCoName}', '{$staffPCode}', '{$staffPhone}', '{$staffAphone}', '{$staffEmail}','{$stType}','{$date}', '{$fileName}', '{$upDate}')";

            $result = mysqli_query($conn, $sql) or die("query failed");

            if ($result) {
                $last_id = mysqli_insert_id($conn);
                if ($last_id) {
                    $code = "00";
                    $staffId = "EDXS" . $code . $last_id;
                    $query = "UPDATE staffDetails SET staffId = '{$staffId}' WHERE id = '{$last_id}' ";
                    $result = mysqli_query($conn, $query);
                }

                header("Location: {$domain}/admin/staffregsuccess.php?id={$staffId}");
            }

            mysqli_close($conn);
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
    <title>Staff Registration</title>
    <link rel="stylesheet" href="admincss/admins.css">
    <style>
        #nonrc {
            height: calc(100vh - 120px);
        }

        #nonbtn {
            margin-top: 45px;
        }
    </style>
</head>

<body>

    <head>
        <?php include 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php' ?>

        <div class="right-con">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="registration-form" id="nonrc">
                    <div class="tsr">
                        <h3>Staff Registration Form</h3>
                    </div>
                    <div class="input-tittle">Personal Details : </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="staffName">Staff Full Name </label>
                            <input class="ibm" type="text" name="staffName" id="staffName" value="<?php echo $staffName; ?>" autocomplete="off">
                            <span><?php echo $nameErr; ?></span>
                        </div>
                        <div class="input">
                            <label for="staff-fName">Father's Name </label>
                            <input class="ibm" type="text" name="staff-fName" id="staff-fName" value="<?php echo $fName; ?>" autocomplete="off">
                            <span><?php echo $fnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staff-mName">Mother Name(optional) </label>
                            <input class="ibm" type="text" name="staff-mName" id="staff-mName" value="<?php echo $mName; ?>" autocomplete="off">
                            <span><?php echo $mnameErr; ?></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="staffDob">Date of Birth </label>
                            <input type="date" name="staffDob" id="staffDob" value="<?php echo $staffDob; ?>" autocomplete="off">
                            <span><?php echo $dobErr; ?></span>
                        </div>
                        <div class="input">
                            <label for="staffGender">Select Gender </label>
                            <select name="staffGender" id="staffGender">
                                <option selected disabled value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span><?php echo $genderErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staffAdhar">Adhar Number </label>
                            <input type="number" name="staffAdhar" id="staffAdhar" value="<?php echo $staffAdhar; ?>">
                            <span><?php echo $adharErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Address Details : </div>
                    <div class="input-box ">
                        <div class="input">
                            <label for="staff-svName">Street/Village Name </label>
                            <input class="ibm" type="text" name="staff-svName" id="staff-svName" value="<?php echo $staffSVName; ?>">
                            <span><?php echo $svErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staff-cName">City Name </label>
                            <input class="ibm" type="text" name="staff-cName" id="staff-cName" value="<?php echo $staffCName; ?>">
                            <span><?php echo $cnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staff-dName">District Name </label>
                            <input class="ibm" type="text" name="staff-dName" id="staff-dName" value="<?php echo $staffDName; ?>">
                            <span><?php echo $dnameErr; ?></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="staff-sName">State Name </label>
                            <input type="text" name="staff-sName" id="staff-sName" value="<?php echo $staffSName; ?>">
                            <span><?php echo $snameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staff-coName">Country Name </label>
                            <input type="text" name="staff-coName" id="staff-coName" value="<?php echo $staffCoName; ?>">
                            <span><?php echo $conameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="staff-pCode">Pin Code </label>
                            <input type="number" name="staff-pCode" id="staff-pCode" value="<?php echo $staffPCode; ?>">
                            <span><?php echo $pcodeErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Contact Details : </div>
                    <div class="input-box  ">
                        <div class="input">
                            <label for="staffPhone">Phone Number </label>
                            <input type="number" name="staffPhone" id="staffPhone" value="<?php echo $staffPhone; ?>">
                            <span><?php echo $phoneErr; ?></span>
                        </div>

                        <div class="input" style="position:relative;">
                            <label for="staffAphone">Phone Number2(Optional) </label>
                            <input type="number" name="staffAphone" id="staffAphone" value="<?php echo $staffAphone; ?>">
                            <span><?php echo $aphoneErr; ?></span>

                        </div>

                        <div class="input">
                            <label for="staffEmail">Email Address(optional) </label>
                            <input type="text" name="staffEmail" id="staffEmail" value="<?php echo $staffEmail; ?>">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Staff Type & Upload Image : </div>
                    <div class="input-box ">
                        <div class="input iptd">

                            <label for="st-type">Staff Type : </label>
                            <input style="background-color: rgb(231, 231, 231);" readonly type="text" name="st-type" id="st-type" value="Non-Technical">
                        </div>

                        <div class="input iptd">
                            <label for="st-image">Upload Image( Only png, jpg, jpeg allowed. Max - 25kb) : </label>
                            <input type="file" name="st-image" id="st-image" accept=".png, .jpg, .jpeg">
                            <span><?php echo $imgErr; ?></span>
                        </div>
                    </div>

                    <div class="submit-btn" id="nonbtn">
                        <input type="submit" name="save" id="save">
                    </div>
                </div>

            </form>
        </div>

    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>

</body>

</html>