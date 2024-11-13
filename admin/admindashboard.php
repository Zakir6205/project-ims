<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduXpert - Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>

<body>

    <head>
        <?php include_once 'admin-nav.php' ?>
    </head>
    <main>
        <?php include 'admin-menu.php';
        include_once 'config.php';
        $today = date("Y-m-d");
        $currentMonth = date("F");
        $currentYear = date("Y");
        ?>
        <div class="admin-con">
            <div class="admin-box">
                <div class="ad-box">
                    <a href="studentdetails.php" style="text-decoration: none;" class="box box1">
                        <?php
                        $sql1 = "SELECT studentId FROM studentCourseDetails";
                        $res1 = mysqli_query($conn, $sql1) or die("error");
                        $total1 = mysqli_num_rows($res1);
                        ?>
                        <p>Total Enrollment <br><?php echo $total1 ?></p>
                    </a>
                    <div class="box box2">
                        <?php
                        $sql2 = "SELECT * FROM studentCourseDetails WHERE dateOfIn = '{$today}'";
                        $res2 = mysqli_query($conn, $sql2) or die("error");
                        $total2 = mysqli_num_rows($res2);
                        ?>
                        <p>New Enrollment <br><?php echo $total2 ?></p>
                        <p class="since">Enroll Today</p>
                    </div>
                    <div class="box box3">
                        <?php
                        $sql3 = "SELECT * FROM studentCourseDetails WHERE YEAR(dateOfIn) = YEAR(CURDATE()) AND MONTH(dateOfIn) = MONTH(CURDATE())";
                        $res3 = mysqli_query($conn, $sql3) or die("error");
                        $totalcme = mysqli_num_rows($res3);
                        ?>
                        <p>Total Enrollment <br> <?php echo $totalcme ?></p>
                        <p class="since">Enroll Current Month</p>
                    </div>
                    <div class="box box4">
                        <?php
                        $sql4 = "SELECT * FROM studentCourseDetails WHERE YEAR(dateOfIn) = YEAR(CURDATE())";
                        $res4 = mysqli_query($conn, $sql4) or die("error");
                        $total4 = mysqli_num_rows($res4);
                        ?>
                        <p>Total Enrollment <br> <?php echo $total4 ?></p>
                        <p class="since">Enroll Current Year</p>
                    </div>
                    <a style="text-decoration: none; " href="/" class="box box3">
                        <?php
                        $sql5 = "SELECT enqId FROM enquiry WHERE enqDate = '{$today}'";
                        $res5 = mysqli_query($conn, $sql5) or die("error");
                        $total5 = mysqli_num_rows($res5);
                        ?>
                        <p>Total Enquiry <br> <?php echo $total5 ?></p>
                        <p class="since">Today</p>
                    </a>
                    <a style="text-decoration: none;" href="coursedetails.php" class="box box4">
                        <?php
                        $sql7 = "SELECT id FROM courseDetails";
                        $res7 = mysqli_query($conn, $sql7) or die("error");
                        $total7 = mysqli_num_rows($res7);
                        ?>
                        <p>Total Courses <br><?php echo $total7 ?></p>
                    </a>
                    <a href="payment-report.php" style="text-decoration: none;" class="box box1">
                        <?php
                        $totalcollection = 0;
                        $totaldue = 0;
                        $sql8 = "SELECT stuPAmt, Feedue FROM studentCourseDetails";
                        $res8 = mysqli_query($conn, $sql8) or die("error");
                        if ($total8 = mysqli_num_rows($res8)) {
                            while ($amt = mysqli_fetch_assoc($res8)) {
                                $totalcollection += $amt['stuPAmt'];
                                $totaldue += $amt['Feedue'];
                            }
                        }
                        ?>
                        <p style="font-size: 16px; font-weight:normal">Total Collection <br>₹ <?php echo $totalcollection ?></p>
                        <p style="font-size: 16px; font-weight:normal;">Total Due <br>₹ <?php echo $totaldue ?></p>
                    </a>
                    <a href="payment-report.php" style="text-decoration: none;" class="box box2">
                        <?php
                        $totalcollection2 = 0;
                        $sql9 = "SELECT payAmt FROM studentPaymentDetails WHERE payDate = '{$today}'";
                        $res9 = mysqli_query($conn, $sql9) or die("error");
                        if ($total9 = mysqli_num_rows($res9)) {
                            while ($amt2 = mysqli_fetch_assoc($res9)) {
                                $totalcollection2 += $amt2['payAmt'];
                            }
                        }
                        ?>
                        <p>Today Collection <br>₹ <?php echo $totalcollection2 ?></p>
                    </a>
                </div>
                <div class="graph-box">
                    <div class="box chart-container">
                        <canvas id="polarChart"></canvas>
                    </div>
                    <div class="box chart-container">
                        <canvas id="monthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include 'footer.php' ?>
    </footer>

    <?php
    $month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $values = array_fill(0, 12, 0);
    $query10 = "SELECT MONTH(dateOfIn) AS month, COUNT(studentId) AS total_value FROM studentCourseDetails WHERE YEAR(dateOfIn) = YEAR(CURDATE()) GROUP BY MONTH(dateOfIn) ORDER BY MONTH(dateOfIn)";
    $result10 = $conn->query($query10);
    while ($row10 = $result10->fetch_assoc()) {
        $month_index = $row10['month'] - 1;
        $values[$month_index] = $row10['total_value'];
    }
    $months_json = json_encode($month_names);
    $values_json = json_encode($values);

    ?>
    <script>
        fetch('coursetypewisechart.php')
            .then(response => response.json())
            .then(data => {
                const labels2 = data.map(item => item.ctName);
                const counts2 = data.map(item => item.studentCount);
                const ctx2 = document.getElementById('polarChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'polarArea',
                    data: {
                        labels: labels2,
                        datasets: [{
                            label: 'Total Enrollment',
                            data: counts2,
                            backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 'rgb(70, 102, 130)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    size: 10
                                },
                                formatter: (value) => {
                                    return value;
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            r: {
                                beginAtZero: true
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            })
    </script>
    <script>
        const d = new Date();
        var year = d.getFullYear();
        var months = <?php echo $months_json; ?>;
        var values = <?php echo $values_json; ?>;
        var ctx = document.getElementById('monthChart').getContext('2d');
        var monthChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Enrollment Month Wise - ' + year + '',
                    data: values,
                    backgroundColor: [
                        'rgb(255, 206, 86)', 'rgb(54, 162, 235)', 'rgb(153, 102, 255)', 'rgb(255, 206, 86)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)', 'rgb(255, 99, 132)', 'rgb(50, 102, 130)', 'rgb(75, 192, 192)', 'rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(54, 162, 235)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</body>

</html>