<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher Details</title>
</head>

<body>

    <head>
        <?php include 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php';

        $teacherId = $_GET['id'];

        include 'config.php';
        $sql = "SELECT * FROM teacherDetails WHERE id = {$teacherId}";
        $result = mysqli_query($conn, $sql) or die("query failed");

        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

                <div class="right-con">
                    <form action="updateteacherdata.php" method="post">
                        <div style="height: 100%;" class="registration-form">
                            <div class="tsr">
                                <h3>Edit Teacher Details</h3>
                            </div>
                            <div class="input-tittle">Personal Details : </div>
                            <div class="input-box">
                                <div class="input">
                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    <input type="hidden" name="addedDate" value="<?php echo $row['doj'];?>">
                                    <label class="ibm" for="Name">Teacher Full Name</label>
                                    <input type="text" name="Name" id="Name" value="<?php echo $row['teacherName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="fName">Father's Name</label>
                                    <input type="text" name="fName" id="fName" value="<?php echo $row['fatherName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="mName">Mother Name</label>
                                    <input type="text" name="mName" id="mName" value="<?php echo $row['motherName'];?>">
                                </div>
                            </div>
                            <div class="input-box">
                                <div class="input">
                                    <label for="Dob">Date of Birth</label>
                                    <input type="date" name="Dob" id="Dob" value="<?php echo $row['dob'];?>">
                                </div>

                                <div class="input">
                                    <label for="Gender">Select Gender</label>
                                    <select name="Gender" id="Gender" value="<?php echo $row['gender'];?>">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="input">
                                    <label for="Adhar">Adhar Number</label>
                                    <input type="number" name="Adhar" id="Adhar" value="<?php echo $row['adharNo'];?>">
                                </div>
                            </div>

                            <div class="input-tittle ibt">Address Details : </div>
                            <div class="input-box ">
                                <div class="input">
                                    <label class="ibm" for="svName">Street/Village Name</label>
                                    <input type="text" name="svName" id="svName" value="<?php echo $row['svName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="cName">City Name</label>
                                    <input type="text" name="cName" id="cName" value="<?php echo $row['cityName'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="dName">District Name</label>
                                    <input type="text" name="dName" id="dName" value="<?php echo $row['distName'];?>">
                                </div>
                            </div>
                            <div class="input-box">
                                <div class="input">
                                    <label for="sName">State Name</label>
                                    <input type="text" name="sName" id="sName" value="<?php echo $row['stateName'];?>">
                                </div>

                                <div class="input">
                                    <label for="cName">Country Name</label>
                                    <input type="text" name="coName" id="coName" value="<?php echo $row['countryName'];?>">
                                </div>

                                <div class="input">
                                    <label for="pCode">Pin Code</label>
                                    <input type="number" name="pCode" id="pCode" value="<?php echo $row['pinCode'];?>">
                                </div>
                            </div>

                            <div class="input-tittle ibt">Contact Details : </div>
                            <div class="input-box  ">
                                <div class="input">
                                    <label class="ibm" for="Phone">Phone Number</label>
                                    <input type="number" name="Phone" id="Phone" value="<?php echo $row['phoneNo'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="Aphone">Alternate Phone Number</label>
                                    <input type="number" name="Aphone" id="Aphone" value="<?php echo $row['aPhoneNo'];?>">
                                </div>

                                <div class="input">
                                    <label class="ibm" for="Email">Email Address</label>
                                    <input type="email" name="Email" id="Email" value="<?php echo $row['email'];?>">
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