<?php

$error = "";

if (isset($_POST['login'])) {

    include '../admin/config.php';
    $userId = mysqli_real_escape_string($conn, $_POST['UserId']);
    $userPass = md5($_POST['UserPass']);

    $sql = "SELECT username FROM admin WHERE username = '{$userId}' AND password = '{$userPass}'";
    $sql2 = "SELECT username, staffName, id FROM staffDetails WHERE username = '{$userId}' AND password = '{$userPass}'";
    $sql3 = "SELECT id, username FROM studentDetails WHERE username = '{$userId}' AND password = '{$userPass}' ";


    $result = mysqli_query($conn, $sql) or die("query failed");
    $result2 = mysqli_query($conn, $sql2) or die("query failed");
    $result3 = mysqli_query($conn, $sql3) or die("query failed");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['adminusername'] = $row['username'];

            header("Location: {$domain}/admin/admindashboard.php");
        }
    } elseif (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            session_start();
            $_SESSION['staffusername'] = $row2['username'];
            $_SESSION['staffname'] = $row2['staffName'];
            $_SESSION['staffId'] = $row2['id'];

            header("Location:  {$domain}/staff/staffdashboard.php");
        }
    } elseif (mysqli_num_rows($result3) > 0) {
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $stuId = $row3['id'];
            session_start();
            $_SESSION['studentusername'] = $row3['username'];

            header("Location:  {$domain}/student/studentdashboard.php?id={$stuId}");
        }
    } else {
        $error = "wrong userid and password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <link rel="stylesheet" href="home-style.css">
</head>

<body>

    <head>
        <?php include 'sessionactive.php' ?>
        <div class="header">
            <div class="logo">
                <img src="../admin/image/edu-logo.png" alt="logo">
                <div class="ins-text">
                    <h3>EduXpert</h3>
                    <p>Since 2024</p>
                </div>
            </div>
            <div class="right-nav">
                <a href="../index.php">> Home</a>
            </div>
        </div>
    </head>
    <main>
        <div class="login-con">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-login">
                    <div class="form-tittle"> <img src="../admin/image/login.svg" alt="login">&nbsp; User Login</div>
                    <div style="color: red; font-size:13px; text-align:center;" class="error"><?php echo $error; ?></div>

                    <div class="input">
                        <label class="ups" for="UserId"> <img src="../admin/image/userr.svg" alt="user">
                            <p>User Id : </p>
                        </label>
                        <input type="text" name="UserId" id="UserId" autocomplete="off" required>
                    </div>
                    <div class="input">
                        <label class="ups" for="UserPass"><img src="../admin/image/pass.svg" alt="pass">
                            <p>Password : </p>
                        </label>
                        <input type="password" name="UserPass" id="UserPass">
                        <span>
                            <img src="../admin/image/eye.svg" alt="eye" id="eye">
                            <img src="../admin/image/offeye.svg" alt="offeye" id="offeye">
                        </span>
                    </div>
                    <button name="login" id="login">Login</button>

                    <div class="forget-pass">
                        <p id="fpass" style="color: blue; cursor:pointer;" >Forgot Password?</p>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include '../admin/footer.php'; ?>
    </footer>

    <script>
        let pass = document.querySelector("#UserPass");
        let eye = document.querySelector("#eye");
        let offeye = document.querySelector("#offeye");
        let fpass = document.querySelector("#fpass");

        offeye.addEventListener("click", () => {
            offeye.style.display = "none";
            eye.style.display = "inline";
            pass.setAttribute("type", "text");
        })

        eye.addEventListener("click", () => {
            eye.style.display = "none";
            offeye.style.display = "inline";
            pass.setAttribute("type", "password");
        })
        fpass.addEventListener("click", () =>{
            alert("Contact your Institute for reset your password!");
        })
    </script>

</body>

</html>