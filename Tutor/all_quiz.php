<?php
session_start();
include '../db_connection.php';

// Check if tutor is logged in
if (!isset($_SESSION['tutor_id'])) {
    echo "<script>alert('Please login first.'); window.location='tutor_login.php';</script>";
    exit();
}

$tutorID = $_SESSION['tutor_id'];

// Handle delete request
if (isset($_GET['delete_id'])) {
    $quiz_id = $_GET['delete_id'];

    // First delete related questions
    $stmt_q = $conn->prepare("DELETE FROM quiz_questions WHERE quiz_id = ?");
    $stmt_q->bind_param("i", $quiz_id);
    $stmt_q->execute();

    // Then delete the quiz
    $stmt_quiz = $conn->prepare("DELETE FROM quizzes WHERE id = ? AND tutor_id = ?");
    $stmt_quiz->bind_param("ii", $quiz_id, $tutorID);
    $stmt_quiz->execute();

    echo "<script>alert('Quiz deleted successfully.'); window.location='view_quizzes.php';</script>";
    exit();
}

// Fetch quizzes created by this tutor
$sql = "SELECT quizzes.*, courses.course_name 
        FROM quizzes 
        JOIN courses ON quizzes.course_id = courses.id 
        WHERE quizzes.tutor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutorID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Quizzes</title>
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
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <?php include 'tutor_sidebar.php'; ?>

    <div class="content">
        <div class="card p-4">
            <h2 class="mb-4">My Quizzes</h2>

            <?php if ($result->num_rows > 0) { ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz Title</th>
                            <th>Description</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($quiz = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($quiz['quiz_title']); ?></td>
                                <td><?= htmlspecialchars($quiz['quiz_description']); ?></td>
                                <td><?= htmlspecialchars($quiz['course_name']); ?></td>
                               <td>
    <a href="check_progress.php?quiz_id=<?= $quiz['id']; ?>" class="btn btn-sm btn-warning">Check Progress</a>
<a href="delete_quiz.php?id=<?= $quiz['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quiz?');">Delete</a>
</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-info">No quizzes found.</div>
            <?php } ?>
        </div>
    </div>

</body>
</html>
