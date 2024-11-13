<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - entrance</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php include 'staff-menu.php';
        include 'config.php';
        ?>
        <div class="course-container">
            <div class="course-tittle">
                <div class="coursenav">
                    <a class="conav" href="coursedetails-staff.php">> All Course</a>
                    <?php
                    $sql2 = "SELECT * FROM courseType";
                    $result2 = mysqli_query($conn, $sql2) or die("error");
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "<a class='conav' href='course-type-wise-staff.php?cid={$row2['ctId']}'>> {$row2['ctName']}</a>";
                        }
                    }
                    ?>
                </div>
            </div>
            <form class="search-course" action="searchcourse-staff.php" method="GET">
                <input type="search" name="search-course" id="search-course" required>
                <button type="submit" name="search" class="secour">Search</button>
            </form>
            <div class="course-con-box">
                <?php
                $courseType = $_GET['cid'];
                $sql = "SELECT id, courseName, courseId, courseFee, courseDate FROM courseDetails WHERE courseTy = '{$courseType}' ORDER BY id DESC";
                $result = mysqli_query($conn, $sql) or die("query failed");

                if (mysqli_num_rows($result) > 0) {
                    $total = mysqli_num_rows($result);
                    echo " <div id='totalcourse'>
                            Entrance - Total Course - $total
                        </div>";
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <div class="course-box">
                            <a class=" click-course" href="coursefulldetails-staff.php?id=<?php echo $row['id'] ?>">
                                <div class="course-box-left">
                                    <p class="cour">Course : </p>
                                    <p class="courname"><?php echo $row['courseName'] ?></p>
                                </div>
                                <div class="course-box-right">
                                    <p class="courid">Course Id - <?php echo $row['courseId'] ?></p>
                                    <p class="courfee">Course Fee - ₹ <?php echo $row['courseFee'] ?>/-</p>
                                    <p class="courdate"> Date Added - <?php echo $row['courseDate'] ?> </p>
                                </div>
                            </a>
                        </div>
                <?php  }
                }  ?>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

</body>

</html>