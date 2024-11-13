<?php require_once 'sessioninactive.php' ?>

<head>
    <link rel="stylesheet" href="admincss/menu.css">
    <link rel="stylesheet" href="coursecss/course.css">
</head>

<div class="sidenav">
    <a class="ad-dash" href="admindashboard.php"><img src="image/dash.svg" alt="dash">Dashboard</a>
    <button class="dropdown-btn"> Student Details
        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
    </button>
    <div class="dropdown-container">
        <a href="studentdetails.php">> Student Details</a>
    </div>
    <button class="dropdown-btn"> Staff Management
        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
    </button>
    <div class="dropdown-container">
        <a href="staff-details.php">> Staff Details</a>
        <a href="staff-registration.php">> Technical Staff Registration</a>
        <a href="non-tech-staff-reg.php">> Non-Technical Staff Registration</a>
    </div>
    <button class="dropdown-btn"> Teacher Management
        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
    </button>
    <div class="dropdown-container">
        <a href="teacher-details.php"> > Teacher Details</a>
        <a href="teacher-reg.php">> Teacher Registration</a>
    </div>
    <button class="dropdown-btn"> Course Management
        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
    </button>
    <div class="dropdown-container">
        <a href="addcourse.php">> Add Course</a>
        <a href="coursedetails.php">> Course Details</a>
    </div>
    <button class="dropdown-btn">Payment Report
        <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
    </button>
    <div class="dropdown-container">
        <a href="payment-report.php">> Course Wise Due Report</a>
    </div>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</div>