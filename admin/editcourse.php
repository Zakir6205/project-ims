<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="coursecss/course.css">
</head>

<body>

    <head>
        <?php include_once 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php' ?>
        <?php
        $courseId = $_GET['id'];
        include 'config.php';
        $sql = "SELECT * FROM courseDetails WHERE id = '{$courseId}'";
        $result = mysqli_query($conn, $sql) or die("query failed");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="add-course-con">
                    <div class="course-data">
                        <form action="updatecourse.php" class="course-form" method="post">
                            <div class="ctxt">
                                Edit Course
                            </div>
                            <div class="course-input-box">
                                <div class="course-input">
                                    <label for="coursetittle">Course Tittle : </label>
                                    <input type="text" name="coursetittle" id="coursetittle" value="<?php echo $row['courseTittle']; ?>">
                                </div>
                                <div class="course-input">
                                    <label for="coursename">Course Name : </label>
                                    <input type="text" name="coursename" id="coursename" value="<?php echo $row['courseName']; ?>">
                                </div>
                            </div>
                            <div class="course-input-box">
                                <div class="course-input cour2">
                                    <label for="coursefee">Course Fee<small>(in rupees)</small> : </label>
                                    <input type="number" name="coursefee" id="coursefee" value="<?php echo $row['courseFee']; ?>">
                                </div>
                                <div class="course-input cour2">
                                    <label for="coursedur">Course Duration<small>(in month)</small> : </label>
                                    <input type="number" name="coursedur" id="coursedur" value="<?php echo $row['courseDuration']; ?>">
                                </div>
                                <div class="course-input cour2">
                                    <label for="course-st-date">Course Start Date : </label>
                                    <?php
                                    $stDateCr = date_create($row['courseStartDate']);
                                    $courseStDate = date(date_format($stDateCr, "Y-m-d"));
                                    ?>
                                    <input type="date" name="course-st-date" id="course-st-date" min="" value="<?php echo $courseStDate ?>">
                                </div>
                            </div>
                            <div class="course-input-box ">

                                <div class="course-input">
                                    <label for="coursetype">Select Type : </label>
                                    <select name="coursetype" id="coursetype">
                                        <?php
                                        $sql3 = "SELECT courseTy, ctName FROM coursetype c INNER JOIN coursedetails d ON c.ctId = d.courseTy WHERE id = '{$courseId}'";
                                        $result3 = mysqli_query($conn, $sql3) or die("query failed");
                                        if (mysqli_num_rows($result3) > 0) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                        ?>
                                                <option value="<?php echo $row3['courseTy']; ?>"><?php echo $row3['ctName']; ?></option>
                                        <?php }
                                        } ?>


                                        <?php
                                        $sql2 = "SELECT * FROM courseType";
                                        $result2 = mysqli_query($conn, $sql2) or die("query failed");
                                        if (mysqli_num_rows($result2) > 0) {
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                        ?>
                                                <option value="<?php echo $row2['ctId']; ?>"><?php echo $row2['ctName']; ?></option>
                                        <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="course-input">
                                    <label for="courselang">Select Language : </label>
                                    <select name="courselang" id="courselang">
                                        <option value="<?php echo $row['courseLang']; ?>"><?php echo $row['courseLang']; ?></option>
                                        <option value="English">English</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Hindi">Hindi/English</option>
                                    </select>
                                </div>
                            </div>
                            <div class="course-input-box ">
                                <div class="course-input disc">
                                    <label for="coursedis">Course Description : </label>
                                    <textarea name="coursedis" id="coursedis" rows="6" cols="40"><?php echo $row['courseDesc']; ?></textarea>
                                </div>
                            </div>

                            <div style="display: none;" class="course-input-box ">
                                <input type="text" name="courseAddedDate" value="<?php echo $row['courseDate']; ?>">
                                <input type="text" name="courseId" value="<?php echo $row['courseId']; ?>">
                            </div>
                            <div class="add-course-btn">
                                <input type="submit" name="update-course" id="add-course" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
        <?php }
        } ?>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("course-st-date").setAttribute("min", today);
    </script>

</body>

</html>