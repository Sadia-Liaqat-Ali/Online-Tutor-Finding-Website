<?php
session_start();
include '../db_connection.php';

// Check if tutor is logged in
if (!isset($_SESSION['tutor_id'])) {
    echo "<script>alert('Please login first.'); window.location='tutor_login.php';</script>";
    exit();
}

$tutorID = $_SESSION['tutor_id'];

// Get students who selected this tutor and are approved
$sql = "SELECT u.studentName, u.email, u.user_id
        FROM uploadvoucher u
        WHERE u.tutorID = ? AND u.status = 'Approved'";

$stmt = $conn->prepare($sql);

// Check if the prepare statement was successful
if ($stmt === false) {
    die('Error in SQL prepare: ' . $conn->error);  // Provide the error if prepare fails
}

$stmt->bind_param("i", $tutorID);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            font-weight: bold;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'tutor_sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="content">
        <div class="card">
            <h2 class="mb-4">My Registered Students</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>User ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['studentName']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['user_id']}</td>
                            </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No students found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
