<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

if (!isset($_GET['id'])) {
    echo "No tutor id provided.";
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM Tutors WHERE tutorid = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Tutor Deleted Successfully'); window.location='view_tutors.php';</script>";
} else {
    echo "Error deleting tutor: " . $conn->error;
}

$conn->close();
?>
