<?php
session_start();
if (!isset($_SESSION['tutor_id']) || !isset($_SESSION['tutorName'])) {
    header("Location: tutor_login.php");
    exit();
}

include '../db_connection.php';

$tutorId = $_SESSION['tutor_id'];
$tutorName = $_SESSION['tutorName'];

$resumeFile = '';
$res = $conn->query("SELECT resume FROM Tutors WHERE id = '$tutorId'");
if ($res && $res->num_rows > 0) {
    $data = $res->fetch_assoc();
    if (!empty($data['resume'])) {
        $resumeFile = '../uploads/' . $data['resume'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resume = $_FILES['resume'];

    if ($resume['error'] === 0 && strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION)) === 'pdf') {
        $newName = uniqid() . '_' . basename($resume['name']);
        $targetPath = "../uploads/" . $newName;

        if (move_uploaded_file($resume['tmp_name'], $targetPath)) {
            $stmt = $conn->prepare("UPDATE Tutors SET resume = ? WHERE id = ?");
            $stmt->bind_param("si", $newName, $tutorId);
            $stmt->execute();
            $stmt->close();

            echo "<script>alert('Resume uploaded successfully!'); window.location='upload_resume.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to upload file.');</script>";
        }
    } else {
        echo "<script>alert('Only PDF files are allowed.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #343a40;
            color: white;
            padding-top: 30px;
            position: fixed;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 220px;
            padding: 40px;
            width: 100%;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .upload-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin: auto;
        }

        .upload-box h4 {
            margin-bottom: 20px;
            color: #ff6f61;
        }

        .btn-upload {
            background-color: #ff6f61;
            border: none;
            color: white;
        }

        .btn-upload:hover {
            background-color: #ff3d2f;
        }
    </style>
</head>
<body>

<?php include 'tutor_sidebar.php'; ?>

<div class="content">
    <div class="upload-box">
        <h4><i class="fas fa-file-upload"></i> 
        <?= file_exists($resumeFile) ? 'Update Your Resume' : 'Upload Your Resume' ?></h4>

        <?php if (file_exists($resumeFile)): ?>
            <p>Resume Uploaded: 
                <a href="<?= $resumeFile ?>" target="_blank" class="btn btn-sm btn-outline-primary">View Resume</a>
            </p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input class="form-control" type="file" name="resume" accept="application/pdf" required>
            <button type="submit" class="btn w-100 mt-2" style="
                background: linear-gradient(135deg, #ff6f61, #ff3d2f);
                color: white;
                font-weight: bold;
                border: none;
                padding: 12px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transition: background 0.3s ease, transform 0.2s ease;
            "
            onmouseover="this.style.transform='scale(1.03)'"
            onmouseout="this.style.transform='scale(1)'">
                <?= file_exists($resumeFile) ? 'Update Resume' : 'Upload Resume' ?>
            </button>
        </form>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
