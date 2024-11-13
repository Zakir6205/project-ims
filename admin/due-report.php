<?php
date_default_timezone_set("Asia/Kolkata");
$courId = $_GET['cid'];
require_once 'config.php';
require_once '../fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage("P", "A4");

$sql = "SELECT courseName, Feedue, dueDate FROM studentCourseDetails s INNER JOIN courseDetails c ON s.courId = c.id WHERE courId = {$courId}";
$result = mysqli_query($conn, $sql) or die("error");
$totaldue = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totaldue += $row['Feedue'];
        $dueDate = $row['dueDate'];
        $courseName = $row['courseName'];
    }
}

$pdf->SetFont("Arial", "", 13);
$pdf->Cell(190, 8, "Course Name - ", 0, 1, "C", false, "");
$pdf->SetFont("Arial", "", 16);
$pdf->Cell(190, 8, "{$courseName}", 0, 1, "C", false, "");

$pdf->SetFont("Arial", "", 11);
$pdf->Cell(95, 8, "Total Due - Rs.{$totaldue}", 0, 0, "L", false, "");
$pdf->Cell(95, 8, "Due Date - {$dueDate}", 0, 1, "R", false, "");

$pdf->Cell(190, 3, "", 0, 1, "", false, "");

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(150, 150, 150);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(25, 8, "SERIAL NO.", 1, 0, "C", true, "");
$pdf->Cell(40, 8, "STUDENT ID", 1, 0, "C", true, "");
$pdf->Cell(58, 8, "STUDENT NAME", 1, 0, "C", true, "");
$pdf->Cell(30, 8, "PHONE NO.", 1, 0, "C", true, "");
$pdf->Cell(37, 8, "DUE AMOUNT", 1, 1, "C", true, "");

$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont("Arial", "", 10);

$sql2 = "SELECT stuId, stuName, phoneNo, Feedue FROM studentCourseDetails a INNER JOIN studentDetails b ON a.studentId = b.id WHERE courId = {$courId} and Feedue > 0";
$result2 = mysqli_query($conn, $sql2) or die("error");
$count = 0;
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $stuName = strtoupper($row2['stuName']);
        $count += 1;
        echo
        $pdf->Cell(25, 8, "{$count}.", 1, 0, "C", false, "");
        $pdf->Cell(40, 8, "{$row2['stuId']}", 1, 0, "C", false, "");
        $pdf->Cell(58, 8, "{$stuName}", 1, 0, "C", false, "");
        $pdf->Cell(30, 8, "{$row2['phoneNo']}", 1, 0, "C", false, "");
        $pdf->Cell(37, 8, "Rs. {$row2['Feedue']}", 1, 1, "C", false, "");
    }
}

$pdf->Output("I", "duereport.pdf");
