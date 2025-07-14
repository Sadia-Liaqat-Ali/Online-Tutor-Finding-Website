<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['tutor_id'])) {
    echo "<script>alert('Please login first.'); window.location='tutor_login.php';</script>";
    exit();
}

$tutorID = $_SESSION['tutor_id'];
$success = false;
$deleted = false;

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteID = intval($_GET['delete_id']);
    $del_sql = "DELETE FROM class_links WHERE id = ? AND tutor_id = ?";
    $del_stmt = $conn->prepare($del_sql);
    $del_stmt->bind_param("ii", $deleteID, $tutorID);
    $del_stmt->execute();
    $deleted = true;
}

// Add new class link
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_date = $_POST['class_date'];
    $class_time = $_POST['class_time'];
    $topic = $_POST['topic'];
    $class_link = $_POST['class_link'];

    $sql_insert = "INSERT INTO class_links (tutor_id, class_date, class_time, topic, class_link) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("issss", $tutorID, $class_date, $class_time, $topic, $class_link);
    $stmt->execute();
    $success = true;
}

// Fetch all shared class links
$sql_classes = "SELECT * FROM class_links WHERE tutor_id = ? ORDER BY class_date DESC, class_time DESC";
$stmt_classes = $conn->prepare($sql_classes);
$stmt_classes->bind_param("i", $tutorID);
$stmt_classes->execute();
$result_classes = $stmt_classes->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tutor Class Links</title>
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
    <script>
        function copyToClipboard(link) {
            navigator.clipboard.writeText(link).then(() => {
                alert("Link copied to clipboard!");
            });
        }
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this class link?")) {
                window.location.href = "?delete_id=" + id;
            }
        }
    </script>
</head>
<body>

<?php include 'tutor_sidebar.php'; ?>

<div class="content">
    <div class="card p-4">
        <h2 class="mb-4">Add & Share Class Links</h2>

        <?php if ($success): ?>
            <div class="alert alert-success">Class link created and shared successfully.</div>
        <?php endif; ?>
        <?php if ($deleted): ?>
            <div class="alert alert-danger">Class link deleted successfully.</div>
        <?php endif; ?>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label">Class Date</label>
                <input type="date" name="class_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Class Time</label>
                <input type="time" name="class_time" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Topic</label>
                <input type="text" name="topic" class="form-control" placeholder="e.g. Algebra - Chapter 2" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Class Link</label>
                <input type="url" name="class_link" class="form-control" placeholder="https://zoom/google.com" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-30">Add Class Link</button>
            </div>
        </form>

        <h4 class="mt-4">Shared Classes</h4>
        <?php if ($result_classes->num_rows > 0) { ?>
            <table class="table table-bordered table-striped mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Topic</th>
                        <th>Class Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = $result_classes->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['class_date']; ?></td>
                        <td><?= $row['class_time']; ?></td>
                        <td><?= htmlspecialchars($row['topic']); ?></td>
                        <td>
                            <a href="<?= $row['class_link']; ?>" target="_blank">Join</a>
                        </td>
                       <td>
    <button class="btn btn-success btn-sm" onclick="copyToClipboard('<?= $row['class_link']; ?>')">Copy</button>
    <button class="btn btn-dark btn-sm" onclick="confirmDelete(<?= $row['id']; ?>)">Delete</button>
    <button class="btn btn-primary btn-sm" onclick="showShareOptions('<?= $row['class_link']; ?>', this)">Share</button>
    <div class="share-options d-none mt-2">
        <a target="_blank" class="btn btn-outline-danger btn-sm me-1"
           href="#">Facebook</a>
        <a target="_blank" class="btn btn-outline-danger btn-sm me-1"
           href="#">WhatsApp</a>
        <a target="_blank" class="btn btn-outline-danger btn-sm"
           href="#">Twitter</a>
    </div>
</td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No classes shared yet.</div>
        <?php } ?>
    </div>
</div>
<script>
function showShareOptions(link, btn) {
    const shareDiv = btn.nextElementSibling;
    if (shareDiv.classList.contains('d-none')) {
        const fb = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(link)}`;
        const tw = `https://twitter.com/intent/tweet?url=${encodeURIComponent(link)}`;
        const wa = `https://wa.me/?text=${encodeURIComponent(link)}`;
        const anchors = shareDiv.querySelectorAll("a");

        anchors[0].href = fb;
        anchors[1].href = wa;
        anchors[2].href = tw;

        shareDiv.classList.remove('d-none');
    } else {
        shareDiv.classList.add('d-none');
    }
}
</script>

</body>
</html>
