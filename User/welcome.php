<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include '../db_connection.php';

$user_email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];
$stmt->close();

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['courses'])) {
    $selected_courses = $_POST['courses'];
    $conn->query("DELETE FROM user_courses WHERE user_id = $user_id");
    $stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (?, ?)");
    foreach ($selected_courses as $course_id) {
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
    }
    $stmt->close();
    $success = true;
}

$course_query = $conn->query("SELECT * FROM courses");
$courses = $course_query->fetch_all(MYSQLI_ASSOC);

$user_courses_result = $conn->query("SELECT course_id FROM user_courses WHERE user_id = $user_id");
$user_course_ids = [];
while ($row = $user_courses_result->fetch_assoc()) {
    $user_course_ids[] = $row['course_id'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Learning Platform</title>
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
        }
        
        body {
            font-family: 'Poppins', sans-serif;

            background-color: #f5f7fb;
            color: var(--dark);
        }
        
        .dashboard-container {
                                    padding-left: 200px;

            display: flex;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            padding: 30px;
            transition: all 0.3s;
        }
        
        .welcome-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
            border-left: 5px solid var(--primary);
        }
        
        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .user-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 600;
        }
        
        .user-info h3 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .user-details {
            display: flex;
            gap: 30px;
            margin-top: 15px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-item i {
            color: var(--primary);
            font-size: 18px;
        }
        
        .courses-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .card-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title i {
            color: var(--primary);
        }
        
        .course-checkbox {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: all 0.3s;
            border: 1px solid var(--light-gray);
        }
        
        .course-checkbox:hover {
            border-color: var(--primary);
            background-color: rgba(108, 99, 255, 0.05);
        }
        
        .form-check-input {
            width: 20px;
            height: 20px;
            margin-right: 15px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-save {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-save:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
        }
        
        .btn-edit {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--primary);
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-edit:hover {
            background-color: var(--primary);
            color: white;
        }
        
        .selected-courses {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }
        
        .course-badge {
            background-color: rgba(108, 99, 255, 0.1);
            color: var(--primary);
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .course-badge i {
            font-size: 14px;
        }
        
        .success-alert {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .success-alert i {
            font-size: 20px;
        }
        
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .user-details {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
            <?php include 'sidebar_user.php'; ?>

    <div class="dashboard-container">

        <div class="main-content">
            <?php if ($success): ?>
                <div class="success-alert">
                    <i class="fas fa-check-circle"></i>
                    <span>Your course selection has been successfully updated!</span>
                </div>
            <?php endif; ?>

            <div class="welcome-card">
                <div class="welcome-header">
                    <div class="user-info">
                        <h3>Welcome back, <?php echo $user['username']; ?>!</h3>
                        <p class="text-muted">Here's your personalized learning dashboard</p>
                    </div>
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                    </div>
                </div>
                
                <div class="user-details">
                    <div class="detail-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <small class="text-muted">Email</small>
                            <div><?php echo $user['email']; ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <small class="text-muted">Phone</small>
                            <div><?php echo $user['contact']; ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-user-cog"></i>
                        <div>
                            <small class="text-muted">Account</small>
                            <a href="edit_profile.php" class="btn-edit">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="courses-card">
                <h5 class="card-title"><i class="fas fa-book-open"></i> Available Courses</h5>
                
                <form method="POST">
                    <div class="mb-4">
                        <?php foreach ($courses as $course): ?>
                            <div class="course-checkbox">
                                <input class="form-check-input" type="checkbox" name="courses[]" 
                                    value="<?php echo $course['id']; ?>"
                                    id="course-<?php echo $course['id']; ?>"
                                    <?php if (in_array($course['id'], $user_course_ids)) echo 'checked'; ?>>
                                <label class="form-check-label" for="course-<?php echo $course['id']; ?>">
                                    <?php echo $course['course_name']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button type="submit" class="btn btn-outline-success btn-lg w-20">
                        <i class="fas fa-save me-2"></i> Save Course Selection
                    </button>
                </form>
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