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
        <?php include_once 'admin-menu.php' ?>
        <div class="add-course-con">
            <div class="course-data">
                <form action="savecourse.php" class="course-form" method="post">
                    <div class="ctxt">
                        Add Course
                    </div>
                    <div class="course-input-box">
                        <div class="course-input">
                            <label for="coursetittle">Course Tittle : </label>
                            <input type="text" name="coursetittle" id="coursetittle">
                        </div>
                        <div class="course-input">
                            <label for="coursename">Course Name : </label>
                            <input type="text" name="coursename" id="coursename">
                        </div>
                    </div>
                    <div class="course-input-box">
                        <div class="course-input cour2">
                            <label for="coursefee">Course Fee<small>(in rupees)</small> : </label>
                            <input type="number" name="coursefee" id="coursefee">
                        </div>
                        <div class="course-input cour2">
                            <label for="coursedur">Course Duration<small>(in month)</small> : </label>
                            <input type="number" name="coursedur" id="coursedur">
                        </div>
                        <div class="course-input cour2">                         
                            <label for="course-st-date">Course Start Date : </label>
                            <input type="date" name="course-st-date" id="course-st-date" min="" >
                        </div>
                    </div>
                    <div class="course-input-box ">
                        
                        <div class="course-input">
                            <label for="coursetype">Select Type : </label>
                            <select name="coursetype" id="coursetype">
                                <option selected disabled value="select">Select Course Type</option>
                                <?php
                                include 'config.php';
                                $sql = "SELECT * FROM courseType";
                                $result = mysqli_query($conn, $sql) or die("query failed");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['ctId']}'>{$row['ctName']}</option>"
                                ?>
                                <?php  }
                                } ?>
                            </select>


                        </div>
                        <div class="course-input">
                            <label for="courselang">Select Language : </label>
                            <select name="courselang" id="courselang">
                                <option selected disabled value="select">Select Course Language</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Hindi">Hindi/English</option>
                            </select>
                        </div>
                    </div>
                    <div class="course-input-box ">
                        <div class="course-input disc">
                            <label for="coursedis">Course Description : </label>
                            <textarea name="coursedis" id="coursedis" rows="6" cols="40"></textarea>
                        </div>
                    </div>
                    <div class="add-course-btn">
                        <button type="submit" name="add-course" id="add-course">Add</button>
                    </div>
                </form>
            </div>
        </div>
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