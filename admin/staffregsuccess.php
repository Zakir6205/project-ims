<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success</title>
    <style>

    </style>
</head>

<body>

    <header>
        <?php include_once 'admin-nav.php' ?>
    </header>
    <main>
        <?php include 'admin-menu.php'; ?>
        <div class="success">
            <div class="message">
                <img src="image/success.svg" alt="success">
                <p class="succ">Registration Successful!</p>
            </div>
            <div class="ben">
                <a id='btn1' href='staff-details.php'>Back</a>
            </div>
        </div>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>