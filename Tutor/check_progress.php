<?php
session_start();
include '../db_connection.php';

// Check if tutor is logged in
if (!isset($_SESSION['tutor_id'])) {
    echo "<script>alert('Please login first.'); window.location='tutor_login.php';</script>";
    exit();
}

$tutorID = $_SESSION['tutor_id'];

// Get quiz_id from URL
if (isset($_GET['quiz_id'])) {
    $quizID = intval($_GET['quiz_id']);
} else {
    echo "<script>alert('No quiz selected.'); window.location='tutor_dashboard.php';</script>";
    exit();
}

// Fetch quiz data
$sql_quizzes = "SELECT id, quiz_title, quiz_description, course_id FROM quizzes WHERE tutor_id = ? AND id = ?";
$stmt_quizzes = $conn->prepare($sql_quizzes);
if ($stmt_quizzes === false) {
    die('MySQL prepare error: ' . $conn->error);
}
$stmt_quizzes->bind_param("ii", $tutorID, $quizID);
$stmt_quizzes->execute();
$result_quizzes = $stmt_quizzes->get_result();
if ($result_quizzes->num_rows == 0) {
    echo "<script>alert('Quiz not found or you do not have permission to view it.'); window.location='tutor_dashboard.php';</script>";
    exit();
}

// Fetch quiz result data
$results = [];
$sql_results = "
    SELECT qr.*, u.username
    FROM quiz_results qr
    JOIN users u ON qr.user_id = u.id
    WHERE qr.quiz_id = ?
";
$stmt_results = $conn->prepare($sql_results);
if ($stmt_results === false) {
    die('MySQL prepare error: ' . $conn->error);
}
$stmt_results->bind_param("i", $quizID);
$stmt_results->execute();
$result_results = $stmt_results->get_result();
while ($row = $result_results->fetch_assoc()) {
    $results[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Results</title>
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
        <h2 class="mb-4">Quiz Results for <?= htmlspecialchars($quizID); ?></h2>

        <?php if (!empty($results)) { ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                        <th>Progress</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($results as $row) { 
                        $percentage = ($row['obtained_marks'] / $row['total_marks']) * 100;
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($row['user_id']); ?></td>
<td><span class="badge bg-info text-dark px-3 py-2 rounded-pill"><?= htmlspecialchars($row['username']); ?></span></td>
                        <td><?= $row['total_marks']; ?></td>
                        <td><?= $row['obtained_marks']; ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: <?= $percentage; ?>%;" aria-valuenow="<?= $percentage; ?>"
                                     aria-valuemin="0" aria-valuemax="100">
                                    <?= round($percentage); ?>%
                                </div>
                            </div>
                        </td>
                        <td><?= $row['submitted_at']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No results found for this quiz.</div>
        <?php } ?>
    </div>
</div>

</body>
</html>
