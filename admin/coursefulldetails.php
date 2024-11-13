<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course-full-details</title>
</head>

<body>

    <header>
        <?php include 'admin-nav.php'; ?>
    </header>
    <main>
        <?php include 'admin-menu.php' ?>

        <div class="cfd">
            <div class="cfd-tittle">
                <p>Course Full Details</p>
            </div>
            <?php
            $courseId = $_GET['id'];
            include 'config.php';
            $sql = "SELECT * FROM coursetype c INNER JOIN coursedetails d ON c.ctId = d.courseTy WHERE id = '{$courseId}'";
            $result = mysqli_query($conn, $sql) or die("query failed");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    <div class="cfdf">
                        <div class="course-card">
                            <div class="course-card-left">
                                <p>> Tittle - </p>
                                <h2><?php echo $row['courseTittle']; ?></h2>
                                <p>> Description - </p>
                                <h4><?php echo $row['courseDesc']; ?></h4>
                                <?php
                                $query = "SELECT * FROM studentCourseDetails WHERE courId = '{$courseId}' ";
                                $res = mysqli_query($conn, $query) or die("error");
                                $totalenr = mysqli_num_rows($res);
                                $collection = 0;
                                $totalDue = 0;
                                while ($data = mysqli_fetch_assoc($res)) {
                                    $collection += $data['stuPAmt'];
                                    $totalDue += $data['Feedue'];
                                }
                                ?>
                                <div class="enr">> Total Enrollment - <p style="color:black"><?php echo $totalenr ?></p>
                                </div>
                                <div class="enr">> Total collection - <p style="color:black">₹ <?php echo $collection ?></p>
                                </div>
                                <div class="enr">> Total Due Amount - <p style="color:black">₹ <?php echo $totalDue ?></p>
                                </div>
                                <div class="last">> Last Edited On - <p style="color:black"><?php echo $row['updateDate']; ?></p>
                                </div>
                                <div class="btn">
                                    <a id="edit" href="editcourse.php?id=<?php echo $row['id'] ?>">Modify</a>
                                </div>
                            </div>
                            <div class="course-card-right">
                                <div class="ccr-up">
                                    <div class="cowh">
                                        <p class="cname">Course Name - </p>
                                        <h1 class="coname"><?php echo $row['courseName']; ?></h1>
                                    </div>
                                </div>
                                <div class="ccr-down">
                                    <p class="courid"><img src="image/id.svg" alt="id">Course Id - <?php echo $row['courseId']; ?></p>

                                    <p><img src="image/type.svg" alt="type">Course Type - <?php echo $row['ctName']; ?></p>

                                    <p><img src="image/duration.svg" alt="dur">Course Duration - <?php echo $row['courseDuration']; ?> Months</p>
                                    <p><img src="image/lang.svg" alt="lang">Course Language - <?php echo $row['courseLang']; ?></p>
                                    <p><img src="image/date.svg" alt="date">Course Added On - <?php echo $row['courseDate']; ?></p>
                                    <p><img src="image/dt-start.svg" alt="date">Course Start From - <?php echo $row['courseStartDate']; ?></p>
                                    <p class="coufee">Total Fee - ₹ <?php echo $row['courseFee']; ?>/-</p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>