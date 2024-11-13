<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="coursecss/course.css">
</head>

<body>

    <head>
        <?php include_once 'admin-nav.php';
        include 'config.php';
        ?>
    </head>
    <main>
        <?php include 'admin-menu.php' ?>
        <div class="course-container">
            <div class="course-tittle">
                <div class="coursenav">
                    <a class="conav" href="coursedetails.php">> All Course</a>
                    <?php
                    $sql2 = "SELECT * FROM courseType";
                    $result2 = mysqli_query($conn, $sql2) or die("error");
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "<a class='conav' href='course-type-wise.php?cid={$row2['ctId']}'>> {$row2['ctName']}</a>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            if (isset($_GET['search-course'])) {
                $searchTerm = mysqli_real_escape_string($conn, $_GET['search-course']);
                $sql = "SELECT id, courseName, courseId, courseFee,  courseDate FROM courseDetails WHERE courseName LIKE '%{$searchTerm}%' OR courseId LIKE  '%{$searchTerm}%'  ORDER BY courseId DESC";
                $result = mysqli_query($conn, $sql) or die("query failed");
            ?>
                <form class="search-course" action="searchcourse.php" method="GET">
                    <input type="search" name="search-course" id="search-course" required value="<?php echo  $searchTerm; ?>">
                    <button type="submit" name="search" class="secour">Search</button>
                </form>
                <div class="course-con-box">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $total = mysqli_num_rows($result);
                        echo "<div id='totalcourse'>
                            Total Result -  $total
                        </div>";
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="course-box">
                                <a class=" click-course" href="coursefulldetails.php?id=<?php echo $row['id'] ?>">
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
                <?php }
                    } else {
                        echo "No Record Found.";
                    }
                }  ?>
                </div>
        </div>
    </main>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>