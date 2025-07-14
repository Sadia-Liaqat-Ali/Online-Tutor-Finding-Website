<?php
// Include database connection file
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $username = $_POST["username"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $contact  = $_POST["contact"];
    
    // Use a prepared statement to insert user data into the Users table
    $stmt = $conn->prepare("INSERT INTO Users (UserName, Password, Email, Contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $contact);
    
    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'You can now login with your credentials',
                    confirmButtonColor: '#6c63ff'
                }).then(() => {
                    window.location='user_login.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: '".str_replace("'", "\\'", $conn->error)."',
                    confirmButtonColor: '#6c63ff'
                });
              </script>";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration | TutorFinder</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary);
        }
        
        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h2 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .register-header p {
            color: var(--gray);
            font-size: 15px;
        }
        
        .register-logo {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
        }
        
        .btn-register {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            border: none;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--gray);
        }
        
        .login-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .register-container {
                padding: 30px 20px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h2>Create Your Account</h2>
            <p>Join our community of learners and tutors</p>
        </div>
        
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            
            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus me-2"></i> Register Now
            </button>
            
            <div class="login-link">
                Already have an account? <a href="user_login.php">Login here</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>