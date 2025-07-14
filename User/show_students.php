<?php
session_start();
include '../db_connection.php';
include 'header.php'; // if you use admin sidebar

// Fetch all approved tutor-student records
$sql = "SELECT u.studentName, u.email, u.tutorID, u.user_id, t.FullName AS tutorName
        FROM uploadvoucher u
        JOIN users s ON u.user_id = s.id
        JOIN Tutors t ON u.tutorID = t.ID
        WHERE u.status = 'Approved'
        ORDER BY u.tutorID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approved Students per Tutor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="margin-left:270px; padding:20px;">
    <h2 class="mb-4">Approved Students Registered with Tutors</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tutor Name</th>
                <th>Tutor ID</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Student User ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['tutorName']}</td>
                        <td>{$row['tutorID']}</td>
                        <td>{$row['studentName']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['user_id']}</td>
                    </tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No approved students found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
