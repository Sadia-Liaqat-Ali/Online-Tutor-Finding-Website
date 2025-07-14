<?php
session_start();
include '../db_connection.php';

$sql = "SELECT u.studentName, u.email, u.tutorID, u.user_id, t.tutorName AS tutorName
        FROM uploadvoucher u
        JOIN users s ON u.user_id = s.id
        JOIN Tutors t ON u.tutorID = t.ID
        WHERE u.status = 'Approved'
        ORDER BY u.tutorID";

$result = $conn->query($sql);

if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Students per Tutor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-left: 250px;
            padding: 30px;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            padding: 10px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main content styles */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
            background: white;
        }

        h2 {
            font-weight: bold;
            margin-bottom: 25px;
        }

        .table th {
            background-color: #007bff;
            color: white;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar_admin.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="mb-4">Approved Students Registered with Tutors</h2>
        <div class="card">
            <table class="table">
                <thead >
                    <tr class="text-light">
                        <th style="background-color:#003366; color: white;">#</th>
                        <th style="background-color:#003366; color: white">Tutor Name</th>
                        <th style="background-color:#003366; color: white">Tutor ID</th>
                        <th style="background-color:#003366; color: white">Student Name</th>
                        <th style="background-color:#003366; color: white">Student Email</th>
                        <th style="background-color:#003366; color: white">Student User ID</th>
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
        </div>
    </div>
</body>
</html>
