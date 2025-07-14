<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Get all courses
$all_courses = $conn->query("SELECT * FROM courses")->fetch_all(MYSQLI_ASSOC);

// Get user course ids
$stmt = $conn->prepare("SELECT course_id FROM user_courses WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user_course_ids = [];
while ($row = $result->fetch_assoc()) {
    $user_course_ids[] = $row['course_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f2f4f8;
            font-family: 'Segoe UI', sans-serif;
        }
       
        .sidebar a:hover {
            background: #495057;
            padding-left: 10px;
        }
        .sidebar h4 {
            color: #ffc107;
            margin-bottom: 30px;
        }
        .main-content {
            margin-left: 270px;
            padding: 40px;
        }
        .courses-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .course-badge {
            background-color: #0d6efd;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
        }
    </style>
</head>
<body>

            <?php include 'sidebar_user.php'; ?>


<div class="main-content">
    <div class="courses-card">
        <h5 class="card-title"><i class="fas fa-graduation-cap"></i> Your Current Courses</h5>
        <hr>
        <div class="selected-courses mt-3">
            <?php foreach ($all_courses as $course): ?>
                <?php if (in_array($course['id'], $user_course_ids)): ?>
                    <div class="course-badge">
                        <i class="fas fa-book"></i> <?= htmlspecialchars($course['course_name']); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if (empty($user_course_ids)): ?>
                <div class="text-muted mt-2">You haven't selected any courses yet.</div>
            <?php endif; ?>
        
        <a href="welcome.php" class="btn btn-outline-success">Change Selection</a></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
</body>
</html>
