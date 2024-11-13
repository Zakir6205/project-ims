<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff details</title>
    <link rel="stylesheet" href="staff.css"></head>
<body>

    <header>
        <?php include 'admin-nav.php' ?>
    </header>
    <main>
        <?php include 'admin-menu.php' ?>
        <div class="sdContainer staff-con ">
            <?php
            if (isset($_GET['searchStaff'])) {
                include_once 'config.php';
                $searchTerm = mysqli_real_escape_string($conn, $_GET['searchStaff']);
                $sql = "SELECT staffId, staffName, phoneNo, email, stType FROM staffDetails WHERE staffId LIKE '%{$searchTerm}%' OR staffName LIKE '%{$searchTerm}%' OR stType = '{$searchTerm}' ORDER BY id DESC";
                $result = mysqli_query($conn, $sql) or die("query failed");
            ?>
                <form style="margin-top: 25px;" class="search-course" action="searchstaff.php" method="GET">
                    <input style="width: 45%;" type="search" name="searchStaff" id="search-course" required value="<?php echo $searchTerm; ?>">
                    <button type="submit" name="search-staff" class="secour">Search</button>
                </form>
                <div class="staff-table staff-det-con2">
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr class="th">
                                    <th>Staff Id</th>
                                    <th>Staff Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>More Details</th>
                                </tr>
                            </thead>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $total = mysqli_num_rows($result);
                                echo " <div id='totalcourse'>
                                        <p>Total Result - $total </p>
                                    </div>";
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['staffId']; ?></td>
                                            <td><?php echo $row['staffName']; ?></td>
                                            <td><?php echo $row['phoneNo']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['stType']; ?></td>
                                            <td><a class="more" href="stafffulldetails.php?id=<?php echo $row['staffId']; ?>">More</a></td>
                                        </tr>
                                    </tbody>
                        <?php }
                            } else {
                                echo "No Record Found.";
                            }
                        } ?>
                        </table>
                    </div>
                </div>
        </div>

    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>

</body>

</html>