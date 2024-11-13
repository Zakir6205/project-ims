<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <link rel="stylesheet" href="../admin/coursecss/report.css">
</head>

<body>
    <Header>
        <?php require_once 'admin-nav.php';
        require_once 'config.php';
        ?>
    </Header>
    <Main>
        <?php require_once 'admin-menu.php' ?>
        <div class="report-con course-container">
            <?php
            require_once 'config.php';
            if (isset($_GET['search-payrep'])) {
                $searchTerm = mysqli_real_escape_string($conn, $_GET['search-payrep']);
            }
            $sql = "SELECT courId, courseId, courseName, SUM(Feedue) totaldue, dueDate FROM studentcoursedetails s INNER JOIN coursedetails c ON s.courId = c.id WHERE courseId LIKE '%{$searchTerm}%' OR courseName LIKE '%{$searchTerm}%' AND Feedue > 0 GROUP BY courId, dueDate ORDER BY courId DESC";
            $result = mysqli_query($conn, $sql) or die("error");
            ?>
            <form class="search-course" action="searchpayrep.php" method="GET">
                <label class="sear-cour" for="search-course"></label>
                <input type="search" name="search-payrep" id="search-course" value="<?php echo $searchTerm; ?>" required>
                <button type="submit" name="search" class="secour">Search</button>
            </form>

            <div class="cour-wi-rep">
                <div class="ttl-txt">
                    <p class="rep-title">> Course Wise Total Due - </p>
                </div>
                <div style="box-shadow: none;" class="cour-rep-con">
                    <table>
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Due Amount</th>
                                <th>Due Date</th>
                                <th>Generate Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count += 1;
                            ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['courseId'] ?></td>
                                        <td><?php echo $row['courseName'] ?></td>
                                        <td>₹ <?php echo $row['totaldue'] ?></td>
                                        <td><?php echo $row['dueDate'] ?></td>
                                        <td><a id="gen" href="due-report.php?cid=<?php echo $row['courId'] ?>">Generate</a></td>
                                    </tr>
                            <?php
                                }
                            }else{
                                echo "No Record Found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </Main>
    <footer>
        <?php require_once 'footer.php' ?>
    </footer>

</body>

</html>