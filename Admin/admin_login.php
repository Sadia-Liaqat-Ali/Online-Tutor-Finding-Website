<?php
session_start();
require_once '../db_connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Prepare a statement to check the admin credentials based on Emailid and Password.
    $stmt = $conn->prepare("SELECT * FROM Admin WHERE Emailid = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password); // "ss" for two strings
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a record was found.
    if ($result->num_rows == 1) {
        $_SESSION["admin"] = $email;
        echo "Login successful. Welcome, Admin!";
        // Optionally, redirect to a dashboard page:
        header("Location: admin_dashboard.php");
        // exit;
    } else {
        $error = "Incorrect email or password.";
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
    <title>Admin Login | TutorFinder</title>
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
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(77, 171, 247, 0.1) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            min-height: 600px;
        }
        
        .login-left {
  background: #1f1f2e;
            height: 100%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .login-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -30px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .brand-logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            z-index: 1;
        }
        
        .brand-logo i {
            margin-right: 10px;
            font-size: 32px;
        }
        
        .brand-slogan {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            z-index: 1;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            z-index: 1;
        }
        
        .feature-list li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        
        .feature-list li:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
        
        .feature-list i {
            font-size: 18px;
            margin-right: 12px;
            width: 24px;
            text-align: center;
        }
        
        .login-right {
            padding: 50px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .form-subtitle {
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
        }
        
        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid var(--light-gray);
            padding-left: 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
        }
        
        .input-group-text {
            background-color: white;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .btn-login {
            background-color: var(--admin-accent);
            color: white;
            border: none;
            height: 50px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .divider span {
            padding: 0 15px;
            color: var(--gray);
            font-size: 14px;
        }
        
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 992px) {
            .login-left {
                display: none;
            }
            
            .login-right {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card row g-0">
            <!-- Left Side - Branding & Features -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="login-left">
                    <div class="brand-logo">
                        <i class="fas fa-user-shield"></i>TutorFinder Admin
                    </div>
                    <p class="brand-slogan">Administrative portal for managing the TutorFinder platform</p>
                    
                    <div class="text-center mb-4">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-3 shadow" alt="Admin Dashboard" style="border: 5px solid rgba(255,255,255,0.2);">
                    </div>
                    
                    <ul class="feature-list">
                        <li>
                            <i class="fas fa-users-cog"></i>
                            <span>Manage users and permissions</span>
                        </li>
                        <li>
                            <i class="fas fa-chart-pie"></i>
                            <span>View platform analytics</span>
                        </li>
                        <li>
                            <i class="fas fa-cog"></i>
                            <span>Configure system settings</span>
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            <span>Advanced security controls</span>
                        </li>
                    </ul>
                    
                    <div class="mt-auto text-center w-100">
                        <p>Need help? <a href="mailto:support@tutorfinder.com" class="text-white fw-bold">Contact support</a></p>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="col-lg-6">
                <div class="login-right">
                    <div class="text-center mb-4 d-block d-lg-none">
                        <div class="brand-logo" style="color: var(--admin-accent);">
                            <i class="fas fa-user-shield"></i>TutorFinder Admin
                        </div>
                    </div>
                    
                    <h1 class="form-title">Admin Portal</h1>
                    <p class="form-subtitle">Sign in to access the administration dashboard</p>
                    
                    <?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>
                    
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Admin Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="admin@tutorfinder.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                <span class="input-group-text bg-white" style="cursor: pointer;" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember this device
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-login w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Login to Dashboard
                        </button>
                        
                        <div class="text-center mt-4">
                            <p>For security reasons, please <a href="#" class="text-decoration-none fw-bold">log out</a> when finished</p>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="small text-muted">© 2023 TutorFinder Admin Portal. Restricted access.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password visibility toggle
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    </script>
</body>
</html>