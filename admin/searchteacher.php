<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher details</title>
    <link rel="stylesheet" href="staff.css">
</head>

<body>

    <head>
        <?php include 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php' ?>
        <div class="sdContainer staff-con ">
            <?php
            if (isset($_GET['searchTeacher'])) {
                include_once 'config.php';
                $searchTerm = mysqli_real_escape_string($conn, $_GET['searchTeacher']);
                $sql = "SELECT teacherId, teacherName, phoneNo, email, tcType FROM teacherDetails  WHERE teacherId LIKE '%{$searchTerm}%' OR teacherName LIKE '%{$searchTerm}%' OR tcType = '{$searchTerm}' ORDER BY id DESC";
                $result = mysqli_query($conn, $sql) or die("query failed");
            ?>
                <form style="margin-top: 25px;" class="search-course" action="searchteacher.php" method="GET">
                    <input style="width: 45%;" type="search" name="searchTeacher" id="search-course" value="<?php echo $searchTerm; ?>" required>
                    <button type="submit" name="search-teacher" class="secour">Search</button>
                </form>
                <div class="staff-table staff-det-con2">
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr class="th">
                                    <th>Teacher Id</th>
                                    <th>Teacher Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Course Type</th>
                                    <th>More Details</th>
                                </tr>
                            </thead>
                            <?php include_once 'config.php';
                            if (mysqli_num_rows($result) > 0) {
                                $total = mysqli_num_rows($result);
                                echo " <div id='totalcourse'>
                                    <p>Total Result - $total </p>
                                </div>";
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['teacherId']; ?></td>
                                            <td><?php echo $row['teacherName']; ?></td>
                                            <td><?php echo $row['phoneNo']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['tcType']; ?></td>
                                            <td><a class="more" href="teacherfulldetails.php?id=<?php echo $row['teacherId']; ?>">More</a></td>
                                        </tr>
                                    </tbody>
                            <?php  }
                            } ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>

    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>

</body>

</html>