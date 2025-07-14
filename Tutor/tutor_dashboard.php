<?php
session_start();

if (!isset($_SESSION['tutorName']) || !isset($_SESSION['tutor_id'])) {
    header("Location: tutor_login.php");
    exit();
}

$tutorName = $_SESSION['tutorName'];
$tutorId = $_SESSION['tutor_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Dashboard | TutorFinder</title>
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
        
        .welcome-message {
            font-size: 18px;
            color: var(--gray);
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
        
        .action-card.upload-resume {
            border-top-color: var(--info);
        }
        
        .action-card.view-students {
            border-top-color: var(--warning);
        }
        
        .action-card.quiz-progress {
            border-top-color: var(--success);
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
        
        .action-icon.upload-resume {
            background: linear-gradient(135deg, var(--info) 0%, #138496 100%);
        }
        
        .action-icon.view-students {
            background: linear-gradient(135deg, var(--warning) 0%, #e0a800 100%);
        }
        
        .action-icon.quiz-progress {
            background: linear-gradient(135deg, var(--success) 0%, #1e7e34 100%);
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
        
        .action-btn.upload-resume {
            background-color: var(--info);
        }
        
        .action-btn.view-students {
            background-color: var(--warning);
        }
        
        .action-btn.quiz-progress {
            background-color: var(--success);
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: white;
        }
        
        .action-btn.upload-resume:hover {
            background-color: #138496;
        }
        
        .action-btn.view-students:hover {
            background-color: #e0a800;
        }
        
        .action-btn.quiz-progress:hover {
            background-color: #1e7e34;
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

<?php include 'tutor_sidebar.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">
                <i class="fas fa-home"></i> Tutor Dashboard
            </h1>
            <p class="welcome-message">Welcome back, <?php echo htmlspecialchars($tutorName); ?>!</p>
        </div>
        <div class="text-muted">
            <i class="fas fa-calendar-alt me-2"></i>
            <?php echo date('F j, Y'); ?>
        </div>
    </div>
    
    <!-- Action Cards Row -->
    <div class="action-row">
        <!-- Upload Resume Card -->
        <div class="action-card upload-resume">
            <div class="action-icon upload-resume">
                <i class="fas fa-file-upload"></i>
            </div>
            <h3 class="action-title">Upload Resume</h3>
            <p class="action-description">Upload your updated resume or CV to keep your profile current</p>
            <div class="action-btn-container">
                <a href="upload_resume.php" class="action-btn upload-resume">Upload Resume</a>
            </div>
        </div>
        
        <!-- View Students Card -->
        <div class="action-card view-students">
            <div class="action-icon view-students">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h3 class="action-title">View Students</h3>
            <p class="action-description">View all students currently assigned to your courses</p>
            <div class="action-btn-container">
                <a href="view_student.php" class="action-btn view-students">View My Students</a>
            </div>
        </div>
        
        <!-- Quiz Progress Card -->
        <div class="action-card quiz-progress">
            <div class="action-icon quiz-progress">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="action-title">Quiz Progress</h3>
            <p class="action-description">Track your students' performance on quizzes and assignments</p>
            <div class="action-btn-container">
                <a href="All_quiz.php" class="action-btn quiz-progress">Check Progress</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>