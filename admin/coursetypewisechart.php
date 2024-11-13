<?php
//course Type enroll
require_once 'config.php';

$sql15 = "SELECT ct.ctName, COUNT(scd.studentId) AS studentCount 
FROM studentCourseDetails scd 
JOIN courseDetails cd ON scd.courId = cd.id 
JOIN courseType ct ON cd.courseTy = ct.ctId 
GROUP BY ct.ctName";

$result15 = $conn->query($sql15);

$data = array();
while($row15 = $result15->fetch_assoc()) {
$data[] = $row15;
}

echo json_encode($data);

