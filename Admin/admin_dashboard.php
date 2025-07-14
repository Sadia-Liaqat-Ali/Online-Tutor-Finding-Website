<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | TutorFinder</title>
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
        
        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin-bottom: 25px;
        }
        
        .action-card {
            flex: 1 1 calc(33.333% - 25px);
            min-width: 300px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            transition: all 0.3s;
            border-top: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .action-card.add-tutor {
            border-top-color: var(--primary);
        }
        
        .action-card.edit-tutor {
            border-top-color: var(--warning);
        }
        
        .action-card.add-category {
            border-top-color: var(--info);
        }
        
        .action-card.manage-category {
            border-top-color: var(--secondary);
        }
        
        .action-card.view-students {
            border-top-color: var(--success);
        }
        
        .action-card.view-vouchers {
            border-top-color: var(--accent);
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }
        
        .action-icon.add-tutor {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }
        
        .action-icon.edit-tutor {
            background: linear-gradient(135deg, var(--warning) 0%, #e0a800 100%);
        }
        
        .action-icon.add-category {
            background: linear-gradient(135deg, var(--info) 0%, #138496 100%);
        }
        
        .action-icon.manage-category {
            background: linear-gradient(135deg, var(--secondary) 0%, #0d6efd 100%);
        }
        
        .action-icon.view-students {
            background: linear-gradient(135deg, var(--success) 0%, #1e7e34 100%);
        }
        
        .action-icon.view-vouchers {
            background: linear-gradient(135deg, var(--accent) 0%, #dc3545 100%);
        }
        
        .action-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .action-description {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .action-btn-container {
            margin-top: auto;
        }
        
        .action-btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        
        .action-btn.add-tutor {
            background-color: var(--primary);
        }
        
        .action-btn.edit-tutor {
            background-color: var(--warning);
        }
        
        .action-btn.add-category {
            background-color: var(--info);
        }
        
        .action-btn.manage-category {
            background-color: var(--secondary);
        }
        
        .action-btn.view-students {
            background-color: var(--success);
        }
        
        .action-btn.view-vouchers {
            background-color: var(--accent);
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: white;
        }
        
        .action-btn.add-tutor:hover {
            background-color: var(--primary-dark);
        }
        
        .action-btn.edit-tutor:hover {
            background-color: #e0a800;
        }
        
        .action-btn.add-category:hover {
            background-color: #138496;
        }
        
        .action-btn.manage-category:hover {
            background-color: #0d6efd;
        }
        
        .action-btn.view-students:hover {
            background-color: #1e7e34;
        }
        
        .action-btn.view-vouchers:hover {
            background-color: #dc3545;
        }
        
        @media (max-width: 1200px) {
            .action-card {
                flex: 1 1 calc(50% - 25px);
            }
        }
        
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .action-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>

<?php include 'sidebar_admin.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-user-shield"></i> Admin Dashboard
        </h1>
        <div class="text-muted">
            <i class="fas fa-calendar-alt me-2"></i>
            <?php echo date('F j, Y'); ?>
        </div>
    </div>
    
    <!-- First Row - 3 Cards -->
    <div class="action-row">
        <!-- Add Tutor Card -->
        <div class="action-card add-tutor">
            <div class="action-icon add-tutor">
                <i class="fas fa-user-plus"></i>
            </div>
            <h3 class="action-title">Add Tutors</h3>
            <p class="action-description">Register new tutors and add their details to the system</p>
            <div class="action-btn-container">
                <a href="add_tutor.php" class="action-btn add-tutor">Add New Tutor</a>
            </div>
        </div>
        
        <!-- Edit Tutor Card -->
        <div class="action-card edit-tutor">
            <div class="action-icon edit-tutor">
                <i class="fas fa-user-edit"></i>
            </div>
            <h3 class="action-title">Edit Tutors</h3>
            <p class="action-description">Update or remove tutor information from the database</p>
            <div class="action-btn-container">
                <a href="view_tutors.php" class="action-btn edit-tutor">Manage Tutors</a>
            </div>
        </div>
        
        <!-- Add Category Card -->
        <div class="action-card add-category">
            <div class="action-icon add-category">
                <i class="fas fa-folder-plus"></i>
            </div>
            <h3 class="action-title">Add Category</h3>
            <p class="action-description">Create new course categories for better organization</p>
            <div class="action-btn-container">
                <a href="add_category.php" class="action-btn add-category">Add Category</a>
            </div>
        </div>
    </div>
    
    <!-- Second Row - 3 Cards -->
    <div class="action-row">
        <!-- Manage Category Card -->
        <div class="action-card manage-category">
            <div class="action-icon manage-category">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3 class="action-title">Manage Categories</h3>
            <p class="action-description">Update or delete existing course categories</p>
            <div class="action-btn-container">
                <a href="manage_category.php" class="action-btn manage-category">Manage Categories</a>
            </div>
        </div>
        
        <!-- View Students Card -->
        <div class="action-card view-students">
            <div class="action-icon view-students">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="action-title">View Students</h3>
            <p class="action-description">See list of all registered students in the system</p>
            <div class="action-btn-container">
                <a href="show_students.php" class="action-btn view-students">View Students</a>
            </div>
        </div>
        
        <!-- View Vouchers Card -->
        <div class="action-card view-vouchers">
            <div class="action-icon view-vouchers">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <h3 class="action-title">View Vouchers</h3>
            <p class="action-description">Check and verify uploaded payment vouchers</p>
            <div class="action-btn-container">
                <a href="manage_voucher.php" class="action-btn view-vouchers">Check Vouchers</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add any custom JavaScript here if needed
</script>
</body>
</html>