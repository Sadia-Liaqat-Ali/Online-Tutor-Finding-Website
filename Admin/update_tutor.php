<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db_connection.php';

// Check if tutor id is provided via GET
if (!isset($_GET['id'])) {
    echo "No tutor id provided.";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM Tutors WHERE tutorid = '$id'";
$result = $conn->query($sql);

// If query fails or no record is found
if (!$result || $result->num_rows == 0) {
    die("Tutor not found or error: " . $conn->error);
}

$tutor = $result->fetch_assoc();

// Form submission logic for updating tutor details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['tutorName'];
    $qualification = $_POST['tutorQualification'];
    $image = $_FILES['tutorPicture']['name'];

    // If a new image is uploaded, move it and update the picture field
    if ($image) {
        move_uploaded_file($_FILES['tutorPicture']['tmp_name'], "images/" . $image);
        $sql = "UPDATE Tutors SET tutorName='$name', tutorQualification='$qualification', tutorPicture='$image' WHERE tutorid='$id'";
    } else {
        $sql = "UPDATE Tutors SET tutorName='$name', tutorQualification='$qualification' WHERE tutorid='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tutor Updated Successfully'); window.location='view_tutors.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Tutor</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }
    h2 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      color: #2c3e50;
    }
    .btn-submit {
      background-color: #27ae60;
      border: none;
      width: 100%;
      padding: 10px;
      color: white;
      border-radius: 5px;
    }
    .btn-submit:hover {
      background-color: #219150;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Update Tutor</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Tutor Name:</label>
        <input type="text" class="form-control" name="tutorName" value="<?php echo $tutor['tutorName']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Qualification:</label>
        <input type="text" class="form-control" name="tutorQualification" value="<?php echo $tutor['tutorQualification']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Picture:</label>
        <input type="file" class="form-control" name="tutorPicture">
        <?php if(!empty($tutor['tutorPicture'])): ?>
          <p>Current Image: <img src="images/<?php echo $tutor['tutorPicture']; ?>" width="50" height="50" alt="Tutor Picture"></p>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn-submit">Update Tutor</button>
    </form>
  </div>
</body>
</html>
