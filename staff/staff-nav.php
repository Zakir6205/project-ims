<?php
session_start();

if (!isset($_SESSION['staffusername'])) {
    header("Location:  {$domain}/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff-nav</title>
    <link rel="stylesheet" href="/admin/admincss/admins.css">
    <link rel="stylesheet" href="/admin/coursecss/course.css">
    <link rel="stylesheet" href="/admin/admincss/menu.css">
    <link rel="stylesheet" href="staffcss/staffstyle.css">
</head>

<body>
    <div class="admin-nav">
        <div class="nav-left">
            <img src="image/edu-logo.png" alt="logo"> EduXpert ( Welcome - <?php echo $_SESSION['staffname'] ?> )
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
                    <a class="ad-dash" href="staffdashboard.php"><img src="image/dash.svg" alt="dash">Dashboard</a>

                    <button class="dropdown-btn">Leads Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="enquiry-details.php">> Enquiry Details</a>
                        <a href="add-enquiry.php">> Add Enquiry</a>
                    </div>
                    <button class="dropdown-btn">Student Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="student-details.php">> Student Details</a>
                        <a href="student-enroll.php">> New Student Enrollment</a>
                    </div>
                    <button class="dropdown-btn">Courses Details
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="coursedetails-staff.php">> Student Details</a>
                    </div>

                    <button class="dropdown-btn">Payment Management
                        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="stu-pay-det.php">> Student Payments Details</a>
                    </div>

                </div>
                <a id="hom" href="staffdashboard.php">> Home</a>
                <a href="logout.php">> Logout</a>

            </div>
        </nav>
    </div>
</body>

</html>