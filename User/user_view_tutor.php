<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: user_login.php");
    exit();
}
include '../db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Tutors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .card {
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-img-top {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #212529;
            padding-top: 30px;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #343a40;
        }
        .sidebar i {
            margin-right: 10px; 
        }
        .sidebar h4 {
            color: #ffc107;
            text-align: center;
            margin-bottom: 30px;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            background-color: #f8f9fa;
        }

        #searchBar {
            margin-bottom: 20px;
            width: 80%;
        }
        #searchButton {
            margin-bottom: 20px;
        }
        .no-tutors {
            display: none;
            font-size: 18px;
            color: #dc3545;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <?php include 'sidebar_user.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 pt-4 main-content">
            <h2 class="text-center mb-4 text-primary">Our Available Tutors</h2>

            <!-- Search Bar with Button -->
            <div class="d-flex mb-4">
                <input type="text" id="searchBar" class="form-control" placeholder="Search tutors by category (e.g., Computer Science, Medical, etc.)" onkeyup="filterTutors()">
                <button id="searchButton" class="btn btn-primary btn-lg" onclick="filterTutors()">Search</button>
            </div>

            <!-- No Tutors Found Message -->
            <div id="noTutorsMessage" class="no-tutors text-center">No tutors found for this category.</div>

            <div class="row" id="tutorList">
                <?php
                $res = $conn->query("SELECT * FROM Tutors");
                while ($row = $res->fetch_assoc()):
                ?>
                <div class="col-md-6 col-lg-4 tutor-card" data-category="<?= strtolower($row['tutorCategory']); ?>">
                    <div class="card">
                        <img src="../img/<?= $row['tutorPicture']; ?>" class="card-img-top" alt="Tutor Image">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= $row['tutorName']; ?></h5>
                            <p class="card-text">
                                <strong>Qualification:</strong> <?= $row['tutorQualification']; ?><br>
                                <strong>Category:</strong> <?= $row['tutorCategory']; ?><br>
                                <strong>Experience:</strong> <?= $row['tutorExperience']; ?> years<br>
                                <strong>Contact:</strong> <?= $row['tutorMobile']; ?><br>
                                <strong>Fee:</strong> <?= $row['tutorFee']; ?> PKR<br>

                                <?php if (!empty($row['resume'])): ?>
                                    <strong>Resume:</strong> 
                                    <a href="uploads/<?= $row['resume']; ?>" target="_blank" class="btn btn-primary btn-lg">View CV</a>
                                <?php else: ?>
                                    <p class="text-danger">No resume available</p>
                                <?php endif; ?>

                                <!-- Select Tutor Button -->
                                <a href="select_tutor.php?id=<?= $row['id']; ?>" class="btn btn-success btn-lg mt-2">Select Tutor</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to filter tutors based on search input
    function filterTutors() {
        var input = document.getElementById("searchBar");
        var filter = input.value.toLowerCase();
        var tutorList = document.getElementById("tutorList");
        var tutors = tutorList.getElementsByClassName("tutor-card");
        var noTutorsMessage = document.getElementById("noTutorsMessage");
        var found = false;

        for (var i = 0; i < tutors.length; i++) {
            var category = tutors[i].getAttribute("data-category");
            if (category.indexOf(filter) > -1) {
                tutors[i].style.display = "";
                found = true;
            } else {
                tutors[i].style.display = "none";
            }
        }

        // Display "No tutors found" message if no match
        if (found) {
            noTutorsMessage.style.display = "none";
        } else {
            noTutorsMessage.style.display = "block";
        }
    }
</script>
</body>
</html>
