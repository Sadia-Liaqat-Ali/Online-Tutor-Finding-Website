<?php
session_start();
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Prepare a statement to select user based on email and password
    $stmt = $conn->prepare("SELECT id, email FROM Users WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        // Valid login - fetch data
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row['id'];     // ✅ user ID stored
        $_SESSION["email"] = $row['email'];    // ✅ email stored

        header("Location: welcome.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location='user_login.php';</script>";
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
    <title>User Login | Online Tutor Finder</title>
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
            border-color: var(--primary);
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
            background-color: var(--primary);
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
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .btn-social {
            flex: 1;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: all 0.3s;
            border: 1px solid var(--light-gray);
            background: white;
        }
        
        .btn-google {
            color: #DB4437;
        }
        
        .btn-google:hover {
            background: rgba(219, 68, 55, 0.1);
            border-color: rgba(219, 68, 55, 0.3);
        }
        
        .btn-facebook {
            color: #4267B2;
        }
        
        .btn-facebook:hover {
            background: rgba(66, 103, 178, 0.1);
            border-color: rgba(66, 103, 178, 0.3);
        }
        
        .btn-social i {
            font-size: 18px;
            margin-right: 8px;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: var(--primary);
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
                        <i class="fas fa-chalkboard-teacher"></i>Online Tutor Finder
                    </div>
                    <p class="brand-slogan">Connecting students with expert tutors for personalized learning experiences</p>
                    
                    <div class="text-center mb-4">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-3 shadow" alt="Tutoring Experience" style="border: 5px solid rgba(255,255,255,0.2);">
                    </div>
                    
                    <ul class="feature-list">
                        <li>
                            <i class="fas fa-search"></i>
                            <span>Find the perfect tutor for your needs</span>
                        </li>
                        <li>
                            <i class="fas fa-calendar-alt"></i>
                            <span>Flexible scheduling options</span>
                        </li>
                        <li>
                            <i class="fas fa-chart-line"></i>
                            <span>Track your learning progress</span>
                        </li>
                        <li>
                            <i class="fas fa-lock"></i>
                            <span>Secure payment processing</span>
                        </li>
                    </ul>
                    
                    <div class="mt-auto text-center w-100">
                        <p>New to our platform? <a href="register.php" class="text-white fw-bold">Create an account</a></p>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="col-lg-6">
                <div class="login-right">
                    <div class="text-center mb-4 d-block d-lg-none">
                        <div class="brand-logo text-primary">
                            <i class="fas fa-chalkboard-teacher"></i>Online Tutor Finder
                        </div>
                    </div>
                    
                    <h1 class="form-title">Welcome Back</h1>
                    <p class="form-subtitle">Sign in to your student account</p>
                    
                    <form action="user_login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                <span class="input-group-text bg-white" style="cursor: pointer;" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <div>
                                <a href="forgot-password.php" class="text-decoration-none">Forgot password?</a>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-login w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign In
                        </button>
                        
                        <div class="divider">
                            <span>or sign in with</span>
                        </div>
                        
                        <div class="social-login">
                            <a href="https://yourdomain.com/auth/google" class="btn btn-social btn-google">
                                <i class="fab fa-google"></i> Google
                            </a>
                            <a href="https://yourdomain.com/auth/facebook" class="btn btn-social btn-facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p>Don't have an account? <a href="register.php" class="text-decoration-none fw-bold">Register here</a></p>
                        </div>
                    </form>
                    
                    <div class="footer-links">
                        <a href="https://yourdomain.com/terms" target="_blank">Terms of Service</a>
                        <a href="https://yourdomain.com/privacy" target="_blank">Privacy Policy</a>
                        <a href="https://yourdomain.com/support" target="_blank">Help Center</a>
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