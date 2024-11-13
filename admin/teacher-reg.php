<?php
require_once 'sessioninactive.php';

$nameErr = $fnameErr = $mnameErr = $dobErr = $genderErr = $adharErr = $svErr = $cnameErr = $dnameErr = $snameErr = $conameErr = $pcodeErr = $phoneErr = $aphoneErr = $emailErr = $typeErr = $imgErr = "";

$Name = $fName = $mName = $Dob = $Gender = $Adhar = $SVName = $CName = $DName = $SName = $CoName = $PCode = $Phone = $Aphone = $Email = $crType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['tecName'])) {
        $nameErr = "*Name is required";
    } else {
        $Name = input_data($_POST['tecName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
            $nameErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['tec-fName'])) {
        $fnameErr = "*Father's Name is required";
    } else {
        $fName = input_data($_POST['tec-fName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $fName)) {
            $fnameErr = "*Enter Valid Name";
        }
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $_POST['tec-mName'])) {
        $mnameErr = "*Enter Valid Name";
    } else {
        $mName = input_data($_POST['tec-mName']);
    }

    if (empty($_POST['tecDob'])) {
        $dobErr = "*Dob is required";
    } else {
        $Dob = input_data($_POST['tecDob']);
    }
    if (empty($_POST['tecGender'])) {
        $genderErr = "*Gender is required";
    } else {
        $Gender = input_data($_POST['tecGender']);
    }

    if (empty($_POST['tecAdhar'])) {
        $adharErr = "*Adhar No. is required";
    } else {
        $Adhar = input_data($_POST['tecAdhar']);
        if (!preg_match("/^[0-9]*$/", $Adhar)) {
            $adharErr = "Enter Valid Adhar Number";
        }
        if (strlen($Adhar) != 12) {
            $adharErr = "Adhar No. contain 12 digit";
        }
    }

    if (empty($_POST['tec-svName'])) {
        $svErr = "*This Field is required";
    } else {
        $SVName = input_data($_POST['tec-svName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $SVName)) {
            $svErr = "*Enter Valid Name";
        }
    }

    if (empty($_POST['tec-cName'])) {
        $cnameErr = "*City is required";
    } else {
        $CName = input_data($_POST['tec-cName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $CName)) {
            $cnameErr = "*Enter Valid City Name";
        }
    }

    if (empty($_POST['tec-dName'])) {
        $dnameErr = "*District is required";
    } else {
        $DName = input_data($_POST['tec-dName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $DName)) {
            $dnameErr = "*Enter Valid District Name";
        }
    }

    if (empty($_POST['tec-sName'])) {
        $snameErr = "*State is required";
    } else {
        $SName = input_data($_POST['tec-sName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $SName)) {
            $snameErr = "*Enter Valid State Name";
        }
    }

    if (empty($_POST['tec-coName'])) {
        $conameErr = "*Country is required";
    } else {
        $CoName = input_data($_POST['tec-coName']);
        if (!preg_match("/^[a-zA-Z ]*$/", $CoName)) {
            $conameErr = "*Enter Valid Country Name";
        }
    }

    if (empty($_POST['tec-pCode'])) {
        $pcodeErr = "*Pin Code is required";
    } else {
        $PCode = input_data($_POST['tec-pCode']);
        if (!preg_match("/^[0-9]*$/", $PCode)) {
            $pcodeErr = "Enter Valid Pin Code";
        }
        if (strlen($PCode) != 6) {
            $pcodeErr = "Pin Code contain 6 digit";
        }
    }

    if (empty($_POST['tecPhone'])) {
        $phoneErr = "*Phone No. is required";
    } else {
        $Phone = input_data($_POST['tecPhone']);
        if (!preg_match("/^[0-9]*$/", $Phone)) {
            $phoneErr = "Enter Valid Phone Number";
        }
        if (strlen($Phone) != 10) {
            $phoneErr = "Phone No. contain 10 digit";
        }
    }

    if (empty($_POST['tecAphone'])) {
        $aphoneErr = "";
    } elseif (!preg_match("/^[0-9]*$/", $_POST['tecAphone'])) {
        $aphoneErr = "Enter Valid Phone Number";
    } elseif (strlen($_POST['tecAphone']) != 10) {
        $aphoneErr = "Phone No. contain 10 digit";
    } else {
        $Aphone = input_data($_POST['tecAphone']);
    }

    if (empty($_POST['tecEmail'])) {
        $emailErr = "";
    } elseif (!filter_var($_POST['tecEmail'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "*Enter Valid Email";
    } else {
        $Email = input_data($_POST['tecEmail']);
    }

    if (empty($_POST['tcc-type'])) {
        $typeErr = "Select Course Type";
    } else {
        $crType = $_POST['tcc-type'];
    }

    if ($_FILES['tc-image']['name'] == "") {
        $imgErr = "Please Upload Image";
    }

    if ($nameErr === "" and $fnameErr === "" and $mnameErr === "" and  $dobErr === "" and  $genderErr ===  "" and $adharErr === "" and  $svErr === "" and  $cnameErr === "" and  $dnameErr ===  "" and $snameErr === "" and  $conameErr ===  "" and $pcodeErr === "" and  $phoneErr ===  "" and $aphoneErr === "" and  $emailErr === "" and $typeErr === "" and  $imgErr ===  "") {
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d");
        $upDate = date("Y-m-d");

        if (isset($_FILES['tc-image'])) {
            $fileName = $_FILES['tc-image']['name'];
            $fileSize = $_FILES['tc-image']['size'];
            $fileTmp = $_FILES['tc-image']['tmp_name'];
            $fileType = $_FILES['tc-image']['type'];
            $fileErr = $_FILES['tc-image']['error'];

            $file_ext = explode('.', $fileName);
            $file_ext_chect = strtolower(end($file_ext));
            $valid_ext = ['png', 'jpg', 'jpeg'];
            if (in_array($file_ext_chect, $valid_ext) && $fileSize <= 25000) {
                move_uploaded_file($fileTmp, "teacheruploadedimg/" . $fileName);
            } else {
                $imgErr = "*Only png, jpg, jpeg and max - 25kb allowed";
            }
        }
        if ($imgErr === "") {
            include_once 'config.php';
            $sql = "INSERT INTO teacherDetails(teacherName, fatherName, motherName, dob, gender, adharNo, svName,cityName, distName, stateName, countryName, pinCode, phoneNo, aPhoneNo, email, tcType, doj, tcImgName, updateDate) VALUES ('{$Name}', '{$fName}', '{$mName}', '{$Dob}', '{$Gender}', '{$Adhar}', '{$SVName}', '{$CName}', '{$DName}', '{$SName}', '{$CoName}', '{$PCode}', '{$Phone}', '{$Aphone}', '{$Email}','{$crType}','{$date}', '{$fileName}', '{$upDate}')";

            $result = mysqli_query($conn, $sql) or die("query failed");

            if ($result) {
                $last_id = mysqli_insert_id($conn);
                if ($last_id) {
                    $code = "00";
                    $teacherId = "EDXT" . $code . $last_id;
                    $query = "UPDATE teacherDetails SET teacherId = '{$teacherId}' WHERE id = '{$last_id}' ";
                    $result = mysqli_query($conn, $query) or die("error");
                    if ($result == true) {
                        header("Location: {$domain}/admin/teacher-details.php");
                        mysqli_close($conn);
                    }
                }
            }
        }
    }
};

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
    <title>Teacher registration</title>
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
                        <h3>Teacher Registration Form</h3>
                    </div>
                    <div class="input-tittle">Personal Details : </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="tecName">Teacher Full Name</label>
                            <input class="ibm" type="text" name="tecName" id="tecName" value="<?php echo $Name ?>">
                            <span><?php echo $nameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-fName">Father's Name</label>
                            <input class="ibm" type="text" name="tec-fName" id="tec-fName" value="<?php echo $fName ?>">
                            <span><?php echo $fnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-mName">Mother Name</label>
                            <input class="ibm" type="text" name="tec-mName" id="tec-mName" value="<?php echo $mName ?>">
                            <span><?php echo $mnameErr; ?></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="tecDob">Date of Birth</label>
                            <input type="date" name="tecDob" id="tecDob" value="<?php echo $Dob ?>">
                            <span><?php echo $dobErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tecGender">Select Gender</label>
                            <select name="tecGender" id="tecGender">
                                <option selected disabled value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span><?php echo $genderErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tecAdhar">Adhar Number</label>
                            <input type="number" name="tecAdhar" id="tecAdhar" value="<?php echo $Adhar ?>">
                            <span><?php echo $adharErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Address Details : </div>
                    <div class="input-box ">
                        <div class="input">
                            <label for="tec-svName">Street/Village Name</label>
                            <input class="ibm" type="text" name="tec-svName" id="tec-svName" value="<?php echo $SVName ?>">
                            <span><?php echo $svErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-cName">City Name</label>
                            <input class="ibm" type="text" name="tec-cName" id="tec-cName" value="<?php echo $CName ?>">
                            <span><?php echo $cnameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-dName">District Name</label>
                            <input class="ibm" type="text" name="tec-dName" id="tec-dName" value="<?php echo $DName ?>">
                            <span><?php echo $dnameErr; ?></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input">
                            <label for="tec-sName">State Name</label>
                            <input type="text" name="tec-sName" id="tec-sName" value="<?php echo $SName ?>">
                            <span><?php echo $snameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-cName">Country Name</label>
                            <input type="text" name="tec-coName" id="tec-coName" value="<?php echo $CoName ?>">
                            <span><?php echo $conameErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tec-pCode">Pin Code</label>
                            <input type="number" name="tec-pCode" id="tec-pCode" value="<?php echo $PCode ?>">
                            <span><?php echo $pcodeErr; ?></span>
                        </div>
                    </div>

                    <div class="input-tittle ibt">Contact Details : </div>
                    <div class="input-box  ">
                        <div class="input">
                            <label for="tecPhone">Phone Number</label>
                            <input type="number" name="tecPhone" id="tecPhone" value="<?php echo $Phone ?>">
                            <span><?php echo $phoneErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tecAphone">Alternate Phone Number</label>
                            <input type="number" name="tecAphone" id="tecAphone" value="<?php echo $Aphone ?>">
                            <span><?php echo $aphoneErr; ?></span>
                        </div>

                        <div class="input">
                            <label for="tecEmail">Email Address(optional)</label>
                            <input type="email" name="tecEmail" id="tecEmail" value="<?php echo $Email ?>">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="input-tittle ibt">Course Type & Upload Image : </div>
                    <div class="input-box  ">
                        <div class="input iptd">
                            <label for="tcc-type">Course Type : </label>
                            <select name="tcc-type" id="tcc-type">
                                <option selected disabled value="">Select Course Type</option>
                                <?php
                                include_once 'config.php';
                                $sql = "SELECT * FROM courseType";
                                $res = mysqli_query($conn, $sql) or die("error");
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<option value='{$row['ctName']}'>{$row['ctName']}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <span><?php echo $typeErr; ?></span>
                        </div>

                        <div class="input iptd">
                            <label for="tc-image">Upload Image : </label>
                            <input style="border: none;" type="file" name="tc-image" id="tc-image" accept=".png, .jpg, .jpeg">
                            <span><?php echo $imgErr; ?></span>
                        </div>
                    </div>
                    <div class="submit-btn" id="nonbtn">
                        <input type="submit" name="save">
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