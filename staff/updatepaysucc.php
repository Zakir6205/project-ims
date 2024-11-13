<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>
        <?php include_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php include 'staff-menu.php';
        $stuId = $_GET['sid'];
        $courId = $_GET['cid'];
        $invNo = $_GET['inv'];
        ?>
        <div class="success">
            <div class="message">
                <img src="image/success.svg" alt="success">
                <p class="succ">Payment Successful!</p>
                <a class="btnn" href="print-stu-rec.php?sid=<?php echo $stuId ?>&cid=<?php echo $courId ?>&inv=<?php echo $invNo ?>">Print Receipt</a>
            </div>
            <div class="ben">
                <?php
                include_once 'config.php';
                $sql = "SELECT stuId FROM studentDetails WHERE id = '{$stuId}'";
                $result = mysqli_query($conn, $sql) or die("query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a id='btn1' href='studentpayment.php?id={$row['stuId']}'>Back</a>";
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../admin/footer.php' ?>
    </footer>
</body>

</html>