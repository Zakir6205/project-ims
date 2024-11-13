<?php

date_default_timezone_set("Asia/Kolkata");

$stuId = $_GET['sid'];
$courId = $_GET['cid'];
$invNo = $_GET['inv'];

require_once 'config.php';

$sql = "SELECT stuId, stuName, courseName, invNo, payAmt, payMeth, tranId, payDate FROM studentPaymentDetails s INNER JOIN studentdetails a ON s.studentId = a.id INNER JOIN coursedetails c ON s.courId = c.id WHERE studentId = '{$stuId}' and courId = '{$courId}' and invNo = '{$invNo}'";

$query = "SELECT dateOfIn FROM studentCourseDetails WHERE studentId = {$stuId} and courId = {$courId}";

$result = mysqli_query($conn, $sql) or die("error");

$res = mysqli_query($conn, $query) or die("error");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stuId = $row['stuId'];
        $stuName = strtoupper($row['stuName']);
        $recNo = $row['invNo'];
        $courName = $row['courseName'];
        $payAmt = $row['payAmt'];
        $payMeth = strtoupper($row['payMeth']);
        $tranId = strtoupper($row['tranId']);
        $payDate = $row['payDate'];
    }
}
if (mysqli_num_rows($res) > 0) {
    while ($row2 = mysqli_fetch_assoc($res)) {
        $dateofIn = $row2['dateOfIn'];
    }
}

$downDate = date("d M, Y");

require_once '../fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage("P", "A4");

$pdf->SetFillColor(240, 248, 255);
$pdf->Rect(0, 0, 210, 40, 'F');
$pdf->SetFont('Arial', 'B', 28);
$pdf->SetTextColor(70, 130, 180);
$pdf->Cell(0, 15, 'EduXpert', 0, 1, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 8, '- Sikandarpur Muzaffarpur, Bihar 842001 -', 0, 1, 'C');

$pdf->Cell(190, 12, "", 0, 1);

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(150, 150, 150);
$pdf->SetFont("Arial", "", 15);
$pdf->Cell(190, 8, "Fee Receipt", 0, 1, "C", true, "");

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont("Arial", "", 13);
$pdf->Cell(190, 12, "Invoice No  - {$recNo}", 0, 0, "R", false, "");

$pdf->Cell(190, 8, "", 0, 1);

$pdf->SetFont("Arial", "", 13);
$pdf->Cell(190, 8, "Student Id - {$stuId}", 0, 1, "L", false, "");
$pdf->Cell(190, 8, "Student Name - {$stuName}", 0, 1, "L", false, "");
$pdf->Cell(190, 8, "Date of Enrollment - {$dateofIn}", 0, 1, "L", false, "");

$pdf->Cell(190, 5, "", 0, 1);

$pdf->SetFont("Arial", "", 13);
$pdf->Cell(190, 8, "Enrollment In :- ", 0, 1, "L", false, "");
$pdf->Cell(190, 8, "     Course Name :- {$courName}", 0, 1, "L", false, "");

$pdf->Cell(190, 5, "", 0, 1);

$pdf->Cell(190, 8, "Payment Details", 1, 1, "C", false, "");
$pdf->Cell(95, 8, "Student Paid", 1, 0, "C", false, "");
$pdf->Cell(95, 8, "Rs. {$payAmt}/-", 1, 1, "C", false, "");
$pdf->Cell(95, 8, "Payment Method", 1, 0, "C", false, "");
$pdf->Cell(95, 8, "{$payMeth}", 1, 1, "C", false, "");
$pdf->Cell(95, 8, "Transaction Id", 1, 0, "C", false, "");
$pdf->Cell(95, 8, "{$tranId}", 1, 1, "C", false, "");
$pdf->Cell(95, 8, "Payment Date", 1, 0, "C", false, "");
$pdf->Cell(95, 8, "{$payDate}", 1, 1, "C", false, "");

$pdf->Cell(190, 20, "", 0, 1);

$pdf->SetFont("Arial", "", 12);
$pdf->Cell(95, 7, "Seal of Authority", 0, 0, "L", false, "");
$pdf->Cell(95, 7, "Authority Signature", 0, 1, "R", false, "");

$pdf->Cell(190, 70, "", 0, 1);

$pdf->SetFont("Arial", "", 11);
$pdf->Cell(190, 6, "Contact No. - 1800-10-120, 1800-10-121  Email - eduxpert@gmail.com", 1, 1, "C", false, "");

$pdf->SetFont("Arial", "", 8);
$pdf->Cell(95, 7, "Downloaded On - {$downDate}", 0, 1, "L", false, "");

$pdf->Output("I", "Receipt.pdf");
