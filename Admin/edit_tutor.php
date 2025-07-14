<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

$id = $_GET['id'];
$tutor = $conn->query("SELECT * FROM Tutors WHERE id = $id")->fetch_assoc();

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['tutorName'];
    $qualification = $_POST['tutorQualification'];
    $category = $_POST['tutorCategory'];
    $experience = $_POST['tutorExperience'];
    $address = $_POST['tutorAddress'];
    $mobile = $_POST['tutorMobile'];
    $fee = $_POST['tutorFee'];
    $password = $_POST['tutorPassword']; // Password field

    if ($_FILES['tutorPicture']['name']) {
        $image = $_FILES['tutorPicture']['name'];
        move_uploaded_file($_FILES['tutorPicture']['tmp_name'], "../img/" . $image);
    } else {
        $image = $tutor['tutorPicture'];
    }

    // If a new password is provided, hash it before updating
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE Tutors SET 
                tutorName='$name', 
                tutorQualification='$qualification', 
                tutorCategory='$category',
                tutorExperience='$experience',
                tutorAddress='$address',
                tutorMobile='$mobile',
                tutorFee='$fee',
                tutorPicture='$image',
                password='$hashedPassword' 
                WHERE id=$id";
    } else {
        // If no password is provided, don't update it
        $sql = "UPDATE Tutors SET 
                tutorName='$name', 
                tutorQualification='$qualification', 
                tutorCategory='$category',
                tutorExperience='$experience',
                tutorAddress='$address',
                tutorMobile='$mobile',
                tutorFee='$fee',
                tutorPicture='$image' 
                WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tutor Updated Successfully'); window.location='view_tutors.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch categories
$categories = [];
$result = $conn->query("SELECT category_name FROM categories");
while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tutor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
    </style>
</head>
<body>
    <?php include 'sidebar_admin.php'; ?>

<div class="container">
    <h2 class="text-center text-primary">Edit Tutor</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tutor Name:</label>
            <input type="text" class="form-control" name="tutorName" value="<?= $tutor['tutorName']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Qualification:</label>
            <input type="text" class="form-control" name="tutorQualification" value="<?= $tutor['tutorQualification']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category:</label>
            <select class="form-control" name="tutorCategory" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat; ?>" <?= $tutor['tutorCategory'] == $cat ? 'selected' : ''; ?>><?= $cat; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Experience (Years):</label>
            <input type="number" class="form-control" name="tutorExperience" value="<?= $tutor['tutorExperience']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Picture:</label><br>
            <img src="../img/<?= $tutor['tutorPicture']; ?>" width="100" height="100"><br><br>
            <input type="file" class="form-control" name="tutorPicture">
        </div>

        <div class="mb-3">
            <label class="form-label">Address:</label>
            <textarea class="form-control" name="tutorAddress" required><?= $tutor['tutorAddress']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile Number:</label>
            <input type="text" class="form-control" name="tutorMobile" value="<?= $tutor['tutorMobile']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tutor Fee (PKR):</label>
            <input type="number" class="form-control" name="tutorFee" value="<?= $tutor['tutorFee']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password (Leave empty if not changing):</label>
            <input type="password" class="form-control" name="tutorPassword">
        </div>

        <button type="submit" class="btn btn-warning w-100">Update Tutor</button>
    </form>
</div>
</body>
</html>
