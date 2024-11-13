<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student details</title>
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
            <form style="margin-top: 25px;" class="search-student" action="search-student-pay.php" method="GET">
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
                                <th>Phone</th>
                                <th>Payment Details</th>
                            </tr>
                        </thead>

                        <?php
                        include 'config.php';
                        $sql = "SELECT stuId, stuName, phoneNo FROM studentDetails ORDER BY id DESC ";
                        $result = mysqli_query($conn, $sql) or die("query failed");
                        if (mysqli_num_rows($result) > 0) {
                            $total = mysqli_num_rows($result);
                            echo " <div id='totalstudent'>
                                    <p>Total Result - $total </p>
                                </div>";
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['stuId'] ?></td>
                                        <td><?php echo $row['stuName'] ?></td>
                                        <td><?php echo $row['phoneNo'] ?></td>
                                        <td><a class="view" href="studentpayment.php?id=<?php echo $row['stuId'] ?>">View</a></td>
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