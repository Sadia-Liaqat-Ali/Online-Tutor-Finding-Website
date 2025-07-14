<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

include '../db_connection.php';

// Fetch all categories
$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories | TutorFinder</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c63ff;
            --primary-light: #a5a1ff;
            --primary-dark: #5649db;
            --secondary: #4dabf7;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --success: #28a745;
            --warning: #ffc107;
            --info: #17a2b8;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            margin: 0;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 30px;
            transition: all 0.3s;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .dashboard-title {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .dashboard-title i {
            color: var(--primary);
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 500;
            padding: 15px;
            border: none;
        }
        
        .table tbody tr {
            transition: all 0.2s;
        }
        
        .table tbody tr:hover {
            background-color: rgba(108, 99, 255, 0.05);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
        }
        
        .editable {
            background-color: #fffbe7;
        }
        
        .btn-sm {
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
        }
        
        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }
        
        .btn-danger {
            background-color: var(--accent);
            border-color: var(--accent);
        }
        
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        
        .btn-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: var(--gray);
        }
        
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<?php include 'sidebar_admin.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-folder-open"></i> Manage Categories
        </h1>
        <div class="text-muted">
            <i class="fas fa-calendar-alt me-2"></i>
            <?php echo date('F j, Y'); ?>
        </div>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="background-color:#003366;">#</th>
                    <th style="background-color:#003366;">Category Name</th>
                    <th style="background-color:#003366;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <form action="update_category.php" method="POST">
                                <td><?= $i++; ?></td>
                                <td>
                                    <input type="text" name="category_name" class="form-control editable" 
                                           value="<?= htmlspecialchars($row['category_name']) ?>" required>
                                    <input type="hidden" name="category_id" value="<?= $row['id'] ?>">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="delete_category.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="no-data">
                            <i class="fas fa-folder-open fa-2x mb-3"></i>
                            <p>No categories found. Add your first category to get started.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>