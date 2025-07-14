<?php
session_start();

include '../db_connection.php';
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['voucher_id'], $_POST['new_status'])) {
    $voucher_id = $_POST['voucher_id'];
    $new_status = $_POST['new_status'];

    $stmt = $conn->prepare("UPDATE uploadvoucher SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $voucher_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all vouchers
$sql = "SELECT id, studentName, email, tutorID, filename, status FROM uploadvoucher";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Verify Vouchers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            margin-left: 260px; /* Adjust content to fit with sidebar */
            padding-top: 50px;
        }
        th {
            background-color: #003366;
            color: white;
        }
        .voucher-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .voucher-table th, .voucher-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        .voucher-table tr:hover {
            background-color: #eef;
        }
        .voucher-link {
            color: #007bff;
            text-decoration: none;
        }
        .voucher-link:hover {
            text-decoration: underline;
        }
        select, button {
            padding: 5px;
        }
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .content {
            margin-left: 260px; /* Adjusting content to fit with sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <?php include 'sidebar_admin.php'; ?>
</div>

<!-- Content -->
<div class="content">
    <h2>Uploaded Fee Vouchers</h2>
    <table class="voucher-table">
        <tr>
            <th>Student Name</th>
            <th>Email</th>
            <th>Tutor ID</th>
            <th>Voucher</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['studentName']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['tutorID']) ?></td>
                <td><a class="voucher-link" href="<?= htmlspecialchars($row['filename']) ?>" target="_blank">View</a></td>
                <td class="text-danger"><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="voucher_id" value="<?= $row['id'] ?>">
                        <select name="new_status">
                            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                        <button class="bg-success" type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php $conn->close(); ?>

</body>
</html>
