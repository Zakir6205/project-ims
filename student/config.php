<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Zakira');
define('DB_PASS', 'Zakir@788');
define('DB_NAME', 'eduxpert');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$domain = 'http://localhost:8000';

date_default_timezone_set("Asia/Kolkata");
