<body>
    <div class="sidenav staff-sidenav ">
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
            <a href="coursedetails-staff.php">> Courses Details</a>
        </div>

        <button class="dropdown-btn">Payment Management
            <i class="fa fa-caret-down"><img src="image/drop1.svg" alt="drop"></i>
        </button>
        <div class="dropdown-container">
            <a href="stu-pay-det.php">> Student Payments Details</a>
        </div>

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
</body>