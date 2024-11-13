<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher-details</title>
</head>

<body>

    <head><?php
            include_once 'admin-nav.php'; ?>
    </head>
    <div class="stdc-main">
        <?php include 'admin-menu.php' ?>

        <?php

        $teacherId = $_GET['id'];
        include 'config.php';

        $sql = "SELECT * FROM teacherDetails WHERE teacherId = '{$teacherId}'";
        $result = mysqli_query($conn, $sql) or die("query failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="prob">
                    <div class="stdc">
                        <div class="left-st">
                            <div class="img-con"><img src="teacheruploadedimg/<?php echo $row['tcImgName'] ?>" alt=""></div>
                        </div>
                        <div class="up-st">
                            <h2><?php echo $row['teacherName'] ?> &nbsp; <span>(<?php echo $row['tcType']; ?>)</span></h2>
                            <p id="sp">Teacher ID - <?php echo $row['teacherId'] ?></p>
                            <p id="sw">Serving Since - <?php echo $row['doj']; ?></p>
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
                                            <td class="sdtc-td"><p>> Teacher ID -</p> <?php echo $row['teacherId'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"><p>> Teacher Name -</p> <?php echo $row['teacherName'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p>> Father's Name -</p> <?php echo $row['fatherName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p>> Mother Name -</p> <?php echo $row['motherName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p>> Date of Birth -</p> <?php echo $row['dob'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p>> Gender -</p> <?php echo $row['gender'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p>> Adhar Number -</p> <?php echo $row['adharNo'] ?></td>
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
                                            <td class="sdtc-td"> <p> > State -</p><?php echo $row['stateName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > Country -</p><?php echo $row['countryName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="sdtc-td"> <p> > Pin Code -</p><?php echo $row['pinCode'] ?></td>
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
                        <a id="edit" href="editteacher.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <p id="remove1">Remove</p>
                        <a id="remove2" href="deleteteacher.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </div>
                </div>
        <?php

            }
        }
        ?>
    </div>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    <script>
        let remove1 = document.querySelector("#remove1");
        let remove2 = document.querySelector("#remove2");


        remove1.addEventListener("click", () => {
            if (confirm("The Teacher Will be Removed") == true) {
                remove2.style.display = "inline";
                remove1.style.display = "none";
            } else {
                remove1.style.display = "inline";
                remove2.style.display = "none";
            }
        })
    </script>

</body>

</html>