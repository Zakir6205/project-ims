<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student payment details</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php include 'staff-menu.php';
        include 'config.php';
        $stuId = $_GET['id'];
        ?>

        <div class="payment-con">
            <div class="pay-con">
                <div class="down-pay">
                    <div class="head">
                        <?php
                        $query = "SELECT stuId, stuName FROM studentDetails WHERE stuId = '{$stuId}'";
                        $res = mysqli_query($conn, $query) or die("query failed");
                        if (mysqli_num_rows($res) > 0) {
                            while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                                <p class="name">Student Name - <?php echo $data['stuName'] ?></p>
                                <p class="id">Student Id - <?php echo $data['stuId'] ?></p>
                        <?php
                            }
                        } ?>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Course Fee</th>
                                <th>Student Paid</th>
                                <th>Due Amount</th>
                                <th>Due Date</th>
                                <th>Update Payment</th>
                                <th>Receipt</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT courId, studentId, courseId, courseName, courseFee, stuPAmt, Feedue, dueDate FROM studentcoursedetails s INNER JOIN studentdetails a ON s.studentId = a.id INNER JOIN coursedetails c ON s.courId = c.id WHERE stuId = '{$stuId}' ORDER BY dateOfIn DESC";
                            $result = mysqli_query($conn, $sql) or die("query failed");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $courId = $row['courId'];
                                    $studentId = $row['studentId'];
                            ?>
                                    <tr>
                                        <td><?php echo $row['courseId'] ?></td>
                                        <td><?php echo $row['courseName'] ?></td>
                                        <td>₹ <?php echo $row['courseFee'] ?></td>
                                        <td>₹ <?php echo $row['stuPAmt'] ?></td>
                                        <td>₹ <?php echo $row['Feedue'] ?></td>
                                        <td><?php echo $row['dueDate'] ?></td>
                                        <?php
                                        if ($row['courseFee'] == $row['stuPAmt']) {
                                            echo '<td style="color:green; font-weight:400;"  > Paid </td>';
                                        } else {
                                            echo "<td><a class='update' href='updatepayment.php?cid=$courId&sid=$studentId'>Update</a></td>";
                                        }
                                        ?>
                                        <td> <a style="text-decoration: none; color:blue;" href="selectreceipt.php?cid=<?php echo $courId; ?>&sid=<?php echo $studentId ?>">View</a> </td>
                                    </tr>
                            <?php      }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>

</body>

</html>