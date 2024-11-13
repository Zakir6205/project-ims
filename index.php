<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduXpert-Home</title>
    <link rel="stylesheet" href="home/home-style.css">
    <style>
        #rnh{
            height: 5px;
            width: 40px;
            background-color: blue;
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <head>
        <?php require_once 'home/sessionactive.php' ?>
        <div class="header">
            <div class="logo">
                <img src="../admin/image/edu-logo.png" alt="logo">
                <div class="ins-text">
                    <h3>EduXpert</h3>
                    <p>Since 2024</p>
                </div>
            </div>
            <div class="right-nav" id="rnh">
            </div>
        </div>
    </head>

    <div class="main">
        <div class="container">
            <h2>Welcome to EduXpert</h2>
            <p>“Knowledge is Power, and It Begins with Education.”</p>
            <a href="home/user-login.php">Click Here to Login</a>
        </div>
    </div>
    <footer>
        <?php require_once 'admin/footer.php' ?>
    </footer>

</body>

</html>