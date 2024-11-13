<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student details</title>
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="../staff/staffcss/staffstyle.css">
</head>

<body>

    <header>
        <?php include_once 'admin-nav.php' ?>
    </header>
    <main>
        <?php include 'admin-menu.php' ?>
        <div class="student-det-con">
            <form style="margin-top: 25px;" class="search-student" action="searchstudents.php" method="GET">
                <input style="width: 45%;" type="search" name="searchStudent" id="search-student" required>
                <button type="submit" name="search-student" class="secour">Search</button>
            </form>
            <div class="student-det">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Enroll In <small>(Course Name)</small> </th>
                            </tr>
                        </thead>

                        <?php
                        include 'config.php';
                        $sql = "SELECT stuId, stuName, phoneNo, email, courseName FROM studentCourseDetails scd INNER JOIN studentDetails sd ON sd.id = scd.studentId INNER JOIN courseDetails cd ON cd.id = scd.courId ORDER BY studentId DESC ";
                        $result = mysqli_query($conn, $sql) or die("query failed");
                        if (mysqli_num_rows($result) > 0) {
                            $total = mysqli_num_rows($result);
                            echo " <div id='totalstudent'>
                                    <p>Total Enrollment - $total </p>
                                </div>";
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['stuId'] ?></td>
                                        <td><?php echo $row['stuName'] ?></td>
                                        <td><?php echo $row['phoneNo'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['courseName'] ?></td>
                                    </tr>
                                </tbody>
                        <?php  }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

</body>

</html>