<?php
if (isset($_GET['tutor']) && isset($_GET['subjects']) && isset($_GET['fee']) && isset($_GET['student'])) {
    $tutorName = $_GET['tutor'];
    $subjects = (int) $_GET['subjects'];
    $fee = number_format((float) $_GET['fee'], 2);
    $studentName = $_GET['student'];
    
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="fee_voucher.txt"');

    echo "---------- FEE VOUCHER ----------\n";
    echo "Student Name: $studentName\n";
    echo "Tutor: $tutorName\n";
    echo "Subjects: $subjects\n";
    echo "Total Fee: Rs. $fee\n";
    echo "----------------------------------\n";
    echo "Please pay the dues and upload the paid voucher.\n";
    echo "Thank you for using our service.";
    exit;
} else {
    echo "Missing information to generate voucher.";
}
