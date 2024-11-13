<?php
require_once 'config.php';
require_once '../fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage("P", "A4");

$pdf->SetFont("Arial", "", 16);
$pdf->Cell(190, 8, "-: Course Wise Due Amount :-", 0, 1, "C", false, "");

$pdf->Cell(190, 5, "", 0, 1, "", false, "");

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(150, 150, 150);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(20, 8, "SL. NO.", 1, 0, "C", true, "");
$pdf->Cell(40, 8, "COURSE ID", 1, 0, "C", true, "");
$pdf->Cell(63, 8, "COURSE NAME", 1, 0, "C", true, "");
$pdf->Cell(37, 8, "DUE AMOUNT", 1, 0, "C", true, "");
$pdf->Cell(30, 8, "DUE DATE", 1, 1, "C", true, "");

$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont("Arial", "", 10);

$sql = "SELECT courId, courseId, courseName, SUM(Feedue) totaldue, dueDate FROM studentcoursedetails s INNER JOIN coursedetails c ON s.courId = c.id WHERE Feedue > 0 GROUP BY courId, dueDate ORDER BY courId DESC";
$result = mysqli_query($conn, $sql) or die("error");
$count = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $count += 1;

        $pdf->Cell(20, 8, "{$count}.", 1, 0, "C", false, "");
        $pdf->Cell(40, 8, "{$row['courseId']}", 1, 0, "C", false, "");
        $pdf->Cell(63, 8, "{$row['courseName']}", 1, 0, "C", false, "");
        $pdf->Cell(37, 8, "Rs. {$row['totaldue']}", 1, 0, "C", false, "");
        $pdf->Cell(30, 8, "{$row['dueDate']}", 1, 1, "C", false, "");
    }
}

$pdf->Output("I", "duereport.pdf");
