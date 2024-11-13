<?php require_once 'sessioninactive.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-nav</title>
    <link rel="stylesheet" href="admincss/admins.css">
</head>

<body>
    <div class="admin-nav">
        <div class="nav-left">
            <img src="image/edu-logo.png" alt="logo"> EduXpert ( Welcome - <?php echo $_SESSION['adminusername'] ?> )
        </div>
        <nav>
            <input type="checkbox" id="sidebar-active">
            <label for="sidebar-active" class="open-sidebar-button">
                <img src="image/navmenu.svg" alt="menu">
            </label>

            <label id="overlay" for="sidebar-active"></label>
            <div class="links-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <img src="image/navclose.svg" alt="close">
                </label>
                <div class="sidenav2">
                    <a class="ad-dash" href="admindashboard.php"><img src="image/dash.svg" alt="dash">Dashboard</a>
                    <button style="padding-left: 30px;" class="dropdown-btn">Student Details
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div style="padding-left: 30px;" class="dropdown-container">
                        <a href="studentdetails.php">> Student Details</a>
                    </div>
                    <button style="padding-left: 30px;" class="dropdown-btn">Staff Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="staff-details.php">> Staff Details</a>
                        <a href="staff-registration.php">> Technical Staff Registration</a>
                        <a href="non-tech-staff-reg.php">> Non-Technical Staff Registration</a>
                    </div>
                    <button style="padding-left: 30px;" class="dropdown-btn">Teacher Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div style="padding-left: 30px;" class="dropdown-container">
                        <a href="teacher-details.php"> > Teacher Details</a>
                        <a href="teacher-reg.php">> Teacher Registration</a>
                    </div>
                    <button style="padding-left: 30px;" class="dropdown-btn">Course Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addcourse.php">> Add Course</a>
                        <a href="coursedetails.php">> Course Details</a>
                    </div>
                    <button style="padding-left: 30px;" class="dropdown-btn">Payment Report
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addcourse.php">> Course Wise Due Report</a>
                    </div>
                </div>
                <a id="hom" href="admindashboard.php">> Home</a>
                <a href="logout.php">> Logout</a>

            </div>
        </nav>
    </div>
</body>

</html>