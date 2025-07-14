<?php
session_start();
include '../db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location='../login.php';</script>";
    exit();
}

$userID = $_SESSION['user_id'];
$tutorID = isset($_GET['tutorID']) ? intval($_GET['tutorID']) : 0;

// Fetch class links
$sql = "SELECT * FROM class_links WHERE tutor_id = ? ORDER BY class_date DESC, class_time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutorID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Materials</title>
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
        .thead {
            background-color: #004080;
            color: white;
        }
    </style>
</head>
<body>

<?php include 'sidebar_user.php'; ?>

<div class="content">
    <div class="card p-4">
        <h2 class="mb-4">Class Materials</h2>

        <?php if ($result && $result->num_rows > 0) { ?>
            <table class="table table-bordered table-striped">
                <thead style="background-color: #004080;">
                    <tr>
                        <th >#</th>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Class Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($row['topic']); ?></td>
                            <td><?= htmlspecialchars($row['class_date']); ?></td>
                            <td><?= htmlspecialchars($row['class_time']); ?></td>
                            <td><a href="<?= htmlspecialchars($row['class_link']); ?>" target="_blank" class="btn btn-sm btn-primary">Join Class</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No class materials found.</div>
        <?php } ?>
    </div>
</div>

</body>
</html>
