<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Details</title>
</head>

<body>

    <head>
        <?php include 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php';

        $staffId = $_GET['id'];

        include 'config.php';
        $sql = "SELECT * FROM staffDetails WHERE id = {$staffId}";
        $result = mysqli_query($conn, $sql) or die("query failed");

        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

                <div class="right-con">
                    <form action="updatestaffdata.php" method="post">
                        <div style="height: 100%;" class="registration-form">
                            <div class="tsr">
                                <h3>Edit Staff Details</h3>
                            </div>
                            <div class="input-tittle">Personal Details : </div>
                            <div class="input-box">
                                <div class="input">
                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    <input type="hidden" name="addedDate" value="<?php echo $row['doj'];?>">
                                    <label class="ibm" for="staffName">Staff Full Name</label>
                                    <input type="text" name="staffName" id="staffName" value="<?php echo $row['staffName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staff-fName">Father's Name</label>
                                    <input type="text" name="staff-fName" id="staff-fName" value="<?php echo $row['fatherName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staff-mName">Mother Name</label>
                                    <input type="text" name="staff-mName" id="staff-mName" value="<?php echo $row['motherName'];?>">
                                </div>
                            </div>
                            <div class="input-box">
                                <div class="input">
                                    <label for="staffDob">Date of Birth</label>
                                    <input type="date" name="staffDob" id="staffDob" value="<?php echo $row['dob'];?>">
                                </div>

                                <div class="input">
                                    <label for="staffGender">Select Gender</label>
                                    <select name="staffGender" id="staffGender" value="<?php echo $row['gender'];?>">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="input">
                                    <label for="staffAdhar">Adhar Number</label>
                                    <input type="number" name="staffAdhar" id="staffAdhar" value="<?php echo $row['adharNo'];?>">
                                </div>
                            </div>

                            <div class="input-tittle ibt">Address Details : </div>
                            <div class="input-box ">
                                <div class="input">
                                    <label class="ibm" for="staff-svName">Street/Village Name</label>
                                    <input type="text" name="staff-svName" id="staff-svName" value="<?php echo $row['svName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staff-cName">City Name</label>
                                    <input type="text" name="staff-cName" id="staff-cName" value="<?php echo $row['cityName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staff-dName">District Name</label>
                                    <input type="text" name="staff-dName" id="staff-dName" value="<?php echo $row['distName'];?>">
                                </div>
                            </div>
                            <div class="input-box">
                                <div class="input">
                                    <label for="staff-sName">State Name</label>
                                    <input type="text" name="staff-sName" id="staff-sName" value="<?php echo $row['stateName'];?>">
                                </div>

                                <div class="input">
                                    <label for="staff-cName">Country Name</label>
                                    <input type="text" name="staff-coName" id="staff-coName" value="<?php echo $row['countryName'];?>">
                                </div>

                                <div class="input">
                                    <label for="staff-pCode">Pin Code</label>
                                    <input type="number" name="staff-pCode" id="staff-pCode" value="<?php echo $row['pinCode'];?>">
                                </div>
                            </div>

                            <div class="input-tittle ibt">Contact Details : </div>
                            <div class="input-box  ">
                                <div class="input">
                                    <label class="ibm" for="staffPhone">Phone Number</label>
                                    <input type="number" name="staffPhone" id="staffPhone" value="<?php echo $row['phoneNo'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staffAphone">Alternate Phone Number</label>
                                    <input type="number" name="staffAphone" id="staffAphone" value="<?php echo $row['aPhoneNo'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="staffEmail">Email Address</label>
                                    <input type="email" name="staffEmail" id="staffEmail" value="<?php echo $row['email'];?>">
                                </div>
                            </div>

                            <div class="submit-btn">
                                <input type="submit" name="save" value="update">
                            </div>
                        </div>

                    </form>
            <?php  }
        } ?>
                </div>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>