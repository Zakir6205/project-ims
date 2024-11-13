<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enquiry details</title>
    <link rel="stylesheet" href="/admin/staff.css">
    <link rel="stylesheet" href="staffcss/staffstyle.css">
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php include 'staff-menu.php' ?>
        <div class="student-det-con">
            <form style="margin-top: 25px;" class="search-student" action="searchstudent.php" method="GET">
                <input style="width: 45%;" type="search" name="searchStudent" id="search-student" required>
                <button type="submit" name="search-student" class="secour">Search</button>
            </form>
            <div class="student-det">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Enquiry Id</th>
                                <th>Student Name</th>
                                <th>Phone Number</th>
                                <th>Enquiry For</th>
                                <th>Enquiry Date</th>
                                <th>Added By</th>
                                <th>Enroll Student</th>
                            </tr>
                        </thead>

                        <?php
                        include 'config.php';
                        $sql = "SELECT enqId, eStuName, enqPhoneNo, courseName, enqDate, staffName FROM enquiry e INNER JOIN courseDetails c ON e.eCourId = c.id INNER JOIN staffDetails s ON e.addBy = s.id ORDER BY eid DESC ";
                        $result = mysqli_query($conn, $sql) or die("query failed");
                        if (mysqli_num_rows($result) > 0) {
                            $total = mysqli_num_rows($result);
                            echo " <div id='totalstudent'>
                                    <p>Total Enquiry - $total </p>
                                </div>";
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['enqId'] ?></td>
                                        <td><?php echo $row['eStuName'] ?></td>
                                        <td><?php echo $row['enqPhoneNo'] ?></td>
                                        <td><?php echo $row['courseName'] ?></td>
                                        <td><?php echo $row['enqDate'] ?></td>
                                        <td><?php echo $row['staffName'] ?></td>
                                        <td><a class="view" href="student-enroll.php?id=<?php echo $row['enqId']; ?>">Enroll</a></td>
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