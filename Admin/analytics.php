<?php
include('../db_connection.php');
include 'sidebar_admin.php'; 
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
            --primary-dark: #5649db;
            --secondary: #4dabf7;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --admin-accent: #6c63ff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
        }
        
        .dashboard-content {
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
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            transition: all 0.3s;
            border-left: 5px solid var(--admin-accent);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--admin-accent);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
            background: linear-gradient(135deg, var(--admin-accent) 0%, var(--primary-dark) 100%);
        }
        
        .stat-title {
            font-weight: 500;
            color: var(--gray);
            margin-bottom: 5px;
            font-size: 15px;
        }
        
        .stat-value {
            font-weight: 700;
            color: var(--dark);
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .stat-footer {
            display: flex;
            align-items: center;
            color: var(--gray);
            font-size: 14px;
        }
        
        .stat-footer i {
            margin-right: 8px;
            color: var(--admin-accent);
        }
        
        @media (max-width: 992px) {
            .dashboard-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-content">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <div class="text-muted">
                <i class="fas fa-calendar-alt me-2"></i>
                <?php echo date('F j, Y'); ?>
            </div>
        </div>
        
        <div class="stats-grid">
            <!-- Total Users -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM users");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Total Users</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-database"></i>
                    <span>All registered users</span>
                </div>
            </div>
            
            <!-- Approved Vouchers -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM uploadvoucher WHERE status = 'Approved'");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Approved Vouchers</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-check-circle"></i>
                    <span>Verified payments</span>
                </div>
            </div>
            
            <!-- Total Tutors -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM tutors");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Total Tutors</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-user-tie"></i>
                    <span>Teaching professionals</span>
                </div>
            </div>
            
            <!-- Total Categories -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM categories");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Total Categories</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-folder"></i>
                    <span>Course categories</span>
                </div>
            </div>
            
            <!-- Total Courses -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM courses");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Total Courses</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Available courses</span>
                </div>
            </div>
            
            <!-- Total Quizzes -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <?php
                $query = $conn->query("SELECT COUNT(*) AS total FROM quizzes");
                $row = $query->fetch_assoc();
                ?>
                <div class="stat-title">Total Quizzes</div>
                <div class="stat-value"><?php echo $row['total']; ?></div>
                <div class="stat-footer">
                    <i class="fas fa-check-double"></i>
                    <span>Assessment tests</span>
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