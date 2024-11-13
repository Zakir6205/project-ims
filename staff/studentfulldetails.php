<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student fulldetails</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>
    </header>
    <div class="stdc-main">
        <?php include 'staff-menu.php' ?>

        <?php

        $stuId = $_GET['id'];
        include 'config.php';

        $sql = "SELECT * FROM studentDetails WHERE stuId = '{$stuId}'";
        $result = mysqli_query($conn, $sql) or die("query failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="prob">
                    <div class="stdc">
                        <div class="left-st">
                            <div class="img-con"><img src="studentuploadedimg/<?php echo $row['stuImgName'] ?>" alt="img"></div>
                        </div>
                        <div class="up-st">
                            <h2><?php echo $row['stuName'] ?></h2>
                            <p id="sp">Student ID - <?php echo $row['stuId'] ?></p>
                            <p id="sw">Enrollment Date - <?php echo $row['doe']; ?></p>
                        </div>
                        <div class="bet-st">
                            <div class="tablee">
                                <table class="table table1" cellspacing="0">
                                    <div class="tittle">
                                        <tr>
                                            <th>Personal Details : </th>
                                        </tr>
                                    </div>
                                    <div class="data">
                                        <tr>
                                            <td class="sdtc-td"><p>> Student ID -</p><?php echo $row['stuId'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Student Name -</p><?php echo $row['stuName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Father's Name -</p><?php echo $row['fatherName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Mother Name -</p><?php echo $row['motherName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Date of Birth -</p><?php echo $row['dob'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Gender -</p><?php echo $row['gender'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Adhar Number -</p><?php echo $row['adharNo'] ?></td>
                                        </tr>
                                    </div>
                                </table>
                                <table class="table table2" cellspacing="0">
                                    <div class="tittle">
                                        <tr>
                                            <th> Address Details : </th>
                                        </tr>
                                    </div>
                                    <div class="data">
                                        <tr>
                                            <td class="sdtc-td"> <p> > Street/Village -</p> <?php echo $row['svName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > City -</p> <?php echo $row['cityName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > District -</p> <?php echo $row['distName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > State -</p> <?php echo $row['stateName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > Country -</p> <?php echo $row['countryName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > Pin Code -</p> <?php echo $row['pinCode'] ?></td>
                                        </tr>
                                    </div>
                                </table>
                            </div>
                        </div>
                        <div class="down-st">
                            <p>Contact Info : &nbsp; Phone - <?php echo $row['phoneNo'] ?> &nbsp; Phone2 - <?php echo $row['aPhoneNo'] ?> &nbsp;Email - <?php echo $row['email'] ?></p>
                        </div>
                        <p style="text-align: center; padding: 20px 0px; font-size:14px" class="lastup">> Last Edited On -
                            <?php echo $row['updateDate']; ?></p>
                    </div>
                    <div class="stdc-btn">
                        <a id="edit" href="editstudent.php?id=<?php echo $row['id']; ?>">Edit</a>
                    </div>
                </div>
        <?php

            }
        }
        ?>
    </div>

    </div>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

</body>

</html>