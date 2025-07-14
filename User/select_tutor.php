<?php
include '../db_connection.php';
include 'sidebar_user.php';

if (isset($_GET['id'])) {
    $tutorID = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM tutors WHERE id = ?");
    $stmt->bind_param("i", $tutorID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $tutor = $result->fetch_assoc();
    } else {
        echo "Tutor not found!";
        exit();
    }
    $stmt->close();
} else {
    echo "No tutor selected!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjects = intval($_POST['subjects']);
    $studentName = $_POST['studentName'];
    $totalFee = $tutor['tutorFee'] * $subjects;
    ?>
    <div class="main-content p-4" style="margin-left: 250px;">
        <div class="container mt-5">
            <h2 class="text-success">Fee Voucher</h2>
            <div class="card shadow">
                <div class="card-body">
                    <p><strong>Student Name:</strong> <?= htmlspecialchars($studentName); ?></p>
                    <p><strong>Tutor:</strong> <?= $tutor['tutorName']; ?></p>
                    <p><strong>Subjects:</strong> <?= $subjects; ?></p>
                    <p><strong>Fee per Subject:</strong> <?= $tutor['tutorFee']; ?> PKR</p>
                    <h4><strong>Total Fee:</strong> <?= $totalFee; ?> PKR</h4>

                    <a href="download_voucher.php?tutor=<?= urlencode($tutor['tutorName']) ?>&subjects=<?= $subjects ?>&fee=<?= $totalFee ?>&student=<?= urlencode($studentName) ?>" class="btn btn-outline-success btn-sm mt-2">Download Voucher</a>

                    <form action="upload_voucher.php" method="post" enctype="multipart/form-data" class="mt-4">
                        <label for="voucher" class="form-label">Upload Paid Voucher:</label>
                        <input type="file" name="voucher" class="form-control mb-2" required>
                        <input type="hidden" name="studentName" value="<?= htmlspecialchars($studentName); ?>">
                        <input type="hidden" name="tutorID" value="<?= $tutorID; ?>">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit();
}
?>

<div class="main-content p-4" style="margin-left: 250px;">
    <div class="container mt-4">
        <h2 class="text-primary">Select Tutor</h2>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Tutor: <?= $tutor['tutorName']; ?></h5>
                <p><strong>Qualification:</strong> <?= $tutor['tutorQualification']; ?></p>
                <p><strong>Category:</strong> <?= $tutor['tutorCategory']; ?></p>
                <p><strong>Experience:</strong> <?= $tutor['tutorExperience']; ?> years</p>
                <p><strong>Fee per Subject:</strong> <?= $tutor['tutorFee']; ?> PKR</p>

                <form method="post" class="mt-4">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Your Name</label>
                        <input type="text" name="studentName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="subjects" class="form-label">Number of Subjects</label>
                        <input type="number" name="subjects" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Fee Voucher</button>
                </form>
            </div>
        </div>
    </div>
</div>
