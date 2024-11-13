<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student course details</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php';
        include 'config.php';
        $stuId = $_GET['id'];
        ?>
    </header>
    <main>

        <?php include 'staff-menu.php'; ?>
        <div class="stu-det-conn">

            <div class="carry-con">
                <div class="up">
                    <?php
                    $query = "SELECT stuId, stuName FROM studentDetails WHERE stuId = '{$stuId}'";
                    $res = mysqli_query($conn, $query) or die("query failed");
                    if (mysqli_num_rows($res) > 0) {
                        while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                            <p class="name"><?php echo $data['stuName'] ?></p>
                            <p class="id"> ID - <?php echo $data['stuId'] ?></p>
                            <a href="studentfulldetails.php?id=<?php echo $data['stuId'] ?>" class="pers">View Personal Details</a>

                </div>
                <div class="down">
                    <div class="up-text">
                        <p class="title">
                            > Course Details -
                        </p>
                        <a href="addmorecourse.php?id=<?php echo $data['stuId'] ?>" class="more-cour">Add New Course + </a>
                    </div>
            <?php     }
                    } ?>
            <div class="cour-con">
                <?php
                $sql = "SELECT * FROM studentcoursedetails s INNER JOIN studentdetails a ON s.studentId = a.id INNER JOIN coursedetails c ON s.courId = c.id WHERE stuId = '{$stuId}' ORDER BY dateOfIn DESC";
                $result = mysqli_query($conn, $sql) or die("query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <a href="studentpayment.php?id=<?php echo $stuId ?>" class="box">
                            <p style="font-size: 10px; font-weight:450; ">Course Name - </p>
                            <p class="courname"><?php echo $row['courseName'] ?></p>
                            <p style="font-size: 10px; font-weight:450; ">Course Id - </p>
                            <p class="stucoid"><?php echo $row['courseId'] ?></p>
                            <p style="font-size: 10px; font-weight:450; ">Date of Enroll...</p>
                            <p class="dateofin"><?php echo $row['dateOfIn'] ?></p>
                        </a>
                <?php
                    }
                }
                ?>

            </div>
                </div>
            </div>


        </div>
    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

</body>

</html>