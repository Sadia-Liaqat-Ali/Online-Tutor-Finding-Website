<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['tutorName'];
    $qualification = $_POST['tutorQualification'];
    $category = $_POST['tutorCategory'];
    $experience = $_POST['tutorExperience'];
    $address = $_POST['tutorAddress'];
    $mobile = $_POST['tutorMobile'];
    $fee = $_POST['tutorFee'];
    $password = $_POST['tutorPassword'];
    $confirmPassword = $_POST['tutorConfirmPassword'];
    $image = $_FILES['tutorPicture']['name'];

    // Password matching validation
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        move_uploaded_file($_FILES['tutorPicture']['tmp_name'], "img/" . $image);

        // Encrypt password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Tutors (tutorName, tutorQualification, tutorCategory, tutorExperience, tutorPicture, tutorAddress, tutorMobile, tutorFee, Password) 
                VALUES ('$name', '$qualification', '$category', '$experience', '$image', '$address', '$mobile', '$fee', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Tutor Added Successfully'); window.location='view_tutors.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Fetch categories
$categories = [];
$result = $conn->query("SELECT category_name FROM categories");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Tutor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
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
            margin-left: 250px; /* Adjusts content to avoid overlap with sidebar */
            padding: 40px;
            width: 100%;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php include 'sidebar_admin.php'; ?>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div class="container">
            <h2>Add Tutor</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tutor Name:</label>
                    <input type="text" class="form-control" name="tutorName" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Qualification:</label>
                    <input type="text" class="form-control" name="tutorQualification" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <select class="form-control" name="tutorCategory" required>
                        <option value="" disabled selected>Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Experience (in years):</label>
                    <input type="number" class="form-control" name="tutorExperience" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Picture:</label>
                    <input type="file" class="form-control" name="tutorPicture" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <textarea class="form-control" name="tutorAddress" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobile Number:</label>
                    <input type="text" class="form-control" name="tutorMobile" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tutor Fee (PKR):</label>
                    <input type="number" class="form-control" name="tutorFee" required>
                </div>

                <!-- Password fields -->
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="tutorPassword" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="tutorConfirmPassword" required>
                </div>

                <button type="submit" class="btn-submit">Add Tutor</button>
            </form>
        </div>
    </div>
</body>
</html>
