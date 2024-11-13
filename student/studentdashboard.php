<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student dashboard</title>
    <link rel="stylesheet" href="student.css">
</head>

<body>
    <div class="main">
        <?php
        session_start();
        if (!isset($_SESSION['studentusername'])) {
            header("Location: {$domain}/index.php");
        }
        $stuId = $_GET['id'];
        require_once 'config.php';
        ?>
        <div class="student-menu">
            <div class="menu-up">
                <div class="img">
                    <?php
                    $query = "SELECT stuName, stuId, doe, stuImgName FROM studentDetails WHERE id = '{$stuId}'";
                    $out = mysqli_query($conn, $query) or die("error");
                    if (mysqli_num_rows($out) > 0) {
                        while ($data = mysqli_fetch_assoc($out)) {
                            $stuName = $data['stuName'];
                            $stId = $data['stuId'];
                            $doe = $data['doe'];
                            $img = $data['stuImgName'];
                        }
                    }
                    ?>
                    <img src="../staff/studentuploadedimg/<?php echo $img; ?>" alt="">
                </div>
            </div>
            <div class="menu-down">
                <p class="cpass"><a style="text-decoration: none; color:white; " href="logout.php">Logout</a></p>
            </div>
        </div>
        <div class="cont">
            <div class="up">
                <div class="logo">
                    <img src="../admin/image/edu-logo.png" alt="logo">
                    <div class="ins-text">
                        <h3>EduXpert</h3>
                        <p style="font-size: 10px; font-weight:400;">Since 2024</p>
                    </div>
                </div>
                <div style="text-align: center;" class="left-txt">
                    <span style="font-weight: 400;">Welcome - </span>
                    <span id="name"><?php echo $stuName; ?></span>
                </div>
                <div style="text-align: center;" class="right-txt">
                    <p class="stid">ID - <?php echo $stId; ?></p>
                    <p class="stdoe">D.O.E - <?php echo $doe; ?></p>
                </div>
            </div>
            <div class="down bet">
                <div class="title"> > Your Course Details - </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>D.O.E</th>
                                <th>Start From</th>
                                <th>Duration</th>
                                <th>Language</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT courseName, doe, courseStartDate, courseDuration, courseLang FROM studentcoursedetails s INNER JOIN studentdetails a ON s.studentId = a.id INNER JOIN coursedetails c ON s.courId = c.id WHERE studentId = '{$stuId}' ";
                            $result = mysqli_query($conn, $sql) or die("error");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['courseName']; ?></td>
                                        <td><?php echo $row['doe']; ?></td>
                                        <td><?php echo $row['courseStartDate']; ?></td>
                                        <td><?php echo $row['courseDuration']; ?> Months</td>
                                        <td><?php echo $row['courseLang']; ?></td>
                                    </tr>
                            <?php     }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="bet">
                <div class="title"> > Your Payments Details - </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Fee</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Due Date</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2 = "SELECT courseName, courseFee, stuPAmt, Feedue, dueDate FROM studentcoursedetails s INNER JOIN coursedetails c ON s.courId = c.id WHERE studentId = '{$stuId}' ";
                            $result2 = mysqli_query($conn, $sql2) or die("error");
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <tr>
                                    <td><?php echo $row2['courseName']; ?></td>
                                    <td>₹ <?php echo $row2['courseFee']; ?></td>
                                    <td>₹ <?php echo $row2['stuPAmt']; ?></td>
                                    <td>₹ <?php echo $row2['Feedue']; ?></td>
                                    <td><?php echo $row2['dueDate']; ?></td>
                                    <td><a id="view" href="df">View</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

</html>