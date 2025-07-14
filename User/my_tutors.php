<?php
session_start();
include '../db_connection.php';
include 'sidebar_user.php';

// Get logged-in user's ID
$userID = $_SESSION['user_id']; // Ensure this is set during login

// Fetch tutors with status 'Approved' for the current user, ensuring each tutor is shown only once
$sql = "SELECT DISTINCT t.id AS tutorID, t.tutorName, t.tutorQualification, t.tutorCategory, t.tutorExperience, t.tutorFee 
        FROM uploadvoucher u 
        JOIN tutors t ON u.tutorID = t.id 
        WHERE u.user_id = ? AND u.status = 'Approved'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="main-content p-4" style="margin-left: 250px;">
    <div class="container mt-5">
        <h2 class="text-primary">My Tutors (Paid Vouchers)</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['tutorName']); ?></h5>
                        <p><strong>Qualification:</strong> <?= htmlspecialchars($row['tutorQualification']); ?></p>
                        <p><strong>Category:</strong> <?= htmlspecialchars($row['tutorCategory']); ?></p>
                        <p><strong>Experience:</strong> <?= htmlspecialchars($row['tutorExperience']); ?> years</p>
                        <p><strong>Fee:</strong> <?= htmlspecialchars($row['tutorFee']); ?> PKR</p>
                        <p><strong>Status:</strong> Approved</p>

                        
                        
                        <!-- View Material Button -->
                        <a href="view_material.php?tutorID=<?= $row['tutorID']; ?>" class="btn btn-outline-danger btn-lg mt-2">View Material</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-danger">No tutors found with paid/approved status.</p>
        <?php endif; ?>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>
