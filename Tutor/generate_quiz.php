<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['tutor_id'])) {
    echo "<script>alert('Please login first.'); window.location='tutor_login.php';</script>";
    exit();
}

$tutorID = $_SESSION['tutor_id'];

$sql_courses = "SELECT * FROM courses";
$stmt_courses = $conn->prepare($sql_courses);
$stmt_courses->execute();
$result_courses = $stmt_courses->get_result();

if (isset($_POST['create_quiz'])) {
    $course_id = $_POST['course_id'];
    $quiz_title = $_POST['quiz_title'];
    $quiz_description = $_POST['quiz_description'];

    $sql_quiz = "INSERT INTO quizzes (tutor_id, course_id, quiz_title, quiz_description) VALUES (?, ?, ?, ?)";
    $stmt_quiz = $conn->prepare($sql_quiz);
    $stmt_quiz->bind_param("iiss", $tutorID, $course_id, $quiz_title, $quiz_description);
    $stmt_quiz->execute();
    
    if ($stmt_quiz->affected_rows > 0) {
        $quiz_id = $stmt_quiz->insert_id;

        for ($i = 1; $i <= 5; $i++) {
            $question_text = $_POST["question_text_$i"];
            $option_a = $_POST["option_a_$i"];
            $option_b = $_POST["option_b_$i"];
            $option_c = $_POST["option_c_$i"];
            $correct_option = $_POST["correct_option_$i"];

            $sql_question = "INSERT INTO quiz_questions (quiz_id, question_text, option_a, option_b, option_c, correct_option) 
                             VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_question = $conn->prepare($sql_question);
            $stmt_question->bind_param("isssss", $quiz_id, $question_text, $option_a, $option_b, $option_c, $correct_option);
            $stmt_question->execute();
        }

        echo "<script>alert('Quiz created successfully with 5 questions.');</script>";
    } else {
        echo "<script>alert('Failed to create quiz.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Quiz</title>
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
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include 'tutor_sidebar.php'; ?>

<div class="content">
    <div class="card">
        <h2 class="mb-4 text-center">Generate New Quiz</h2>
        <form action="generate_quiz.php" method="POST">
            <div class="mb-3">
                <label for="course_id" class="form-label">Select Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    <option value="">--Select Course--</option>
                    <?php while ($course = $result_courses->fetch_assoc()) { ?>
                        <option value="<?= $course['id']; ?>"><?= $course['course_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quiz_title" class="form-label">Quiz Title</label>
                <input type="text" name="quiz_title" id="quiz_title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="quiz_description" class="form-label">Quiz Description</label>
                <textarea name="quiz_description" id="quiz_description" class="form-control" required></textarea>
            </div>

            <h5 class="text-primary mt-4">Add 5 Questions</h5>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="mb-3">
                    <label for="question_text_<?= $i ?>" class="form-label">Question <?= $i ?></label>
                    <input type="text" name="question_text_<?= $i ?>" id="question_text_<?= $i ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Options</label>
                    <input type="text" name="option_a_<?= $i ?>" class="form-control mb-1" placeholder="Option A" required>
                    <input type="text" name="option_b_<?= $i ?>" class="form-control mb-1" placeholder="Option B" required>
                    <input type="text" name="option_c_<?= $i ?>" class="form-control mb-1" placeholder="Option C" required>
                </div>
                <div class="mb-4">
                    <label for="correct_option_<?= $i ?>" class="form-label">Correct Answer</label>
                    <select name="correct_option_<?= $i ?>" id="correct_option_<?= $i ?>" class="form-select" required>
                        <option value="A">Option A</option>
                        <option value="B">Option B</option>
                        <option value="C">Option C</option>
                    </select>
                </div>
            <?php } ?>

            <div class="text-center">
                <button type="submit" name="create_quiz" class="btn btn-success w-50">Create Quiz</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
