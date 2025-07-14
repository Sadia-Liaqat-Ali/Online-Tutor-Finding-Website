<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

// Delete Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM Tutors WHERE id = $id");
    echo "<script>alert('Tutor Deleted Successfully'); window.location='view_tutors.php';</script>";
}

// Fetch Tutors
$tutors = [];
$result = $conn->query("SELECT * FROM Tutors");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tutors[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tutors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        table {
            margin-top: 30px;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content {
            margin-left: 260px; /* Adjust this to prevent overlap */
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar_admin.php'; ?>
    </div>

    <!-- Content -->
    <div class="content">
        <h2 class="text-center mt-4 text-primary">Registered Tutors</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Qualification</th>
                    <th>Category</th>
                    <th>Experience</th>
                    <th>Mobile</th>
                    <th>Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tutors as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><img src="../img/<?= $row['tutorPicture']; ?>" alt="Image"></td>
                    <td><?= $row['tutorName']; ?></td>
                    <td><?= $row['tutorQualification']; ?></td>
                    <td><?= $row['tutorCategory']; ?></td>
                    <td><?= $row['tutorExperience']; ?> yrs</td>
                    <td><?= $row['tutorMobile']; ?></td>
                    <td><?= $row['tutorFee']; ?> PKR</td>
                    <td>
                        <a href="edit_tutor.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="view_tutors.php?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this tutor?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
