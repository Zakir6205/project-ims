<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select receipt</title>
</head>

<body>
    <header>
        <?php require_once 'staff-nav.php' ?>
    </header>
    <main>
        <?php require_once 'staff-menu.php' ?>
        <div class="select-rec">
            <div class="rec-cont">
                <p class="sel-txt">> Select Receipt - </p>
                <div class="rec-con-boxes">
                    <?php
                    $sid = $_GET['sid'];
                    $cid = $_GET['cid'];
                    require_once 'config.php';
                    $sql = "SELECT invNo FROM studentPaymentDetails WHERE studentId = '{$sid}' and courId = '{$cid}'";
                    $result = mysqli_query($conn, $sql) or die("error");
                    if (mysqli_num_rows($result)  > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $invNo = $row['invNo'];
                            echo " <a style='text-decoration: none; color:white;' href='print-stu-rec.php?sid=$sid&cid=$cid&inv=$invNo'><div class='box'>{$invNo}</div></a>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php require_once '../admin/footer.php' ?>
    </footer>
</body>

</html>