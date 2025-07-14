<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TutorFinder | Learn Smarter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
   body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to right, #1e90ff, #00bfff);
  margin: 0;
  padding: 0;
  transition: background 0.3s ease;
}

/* Hero Section */
.hero {
  background: linear-gradient(to right, #1e3c72, #2a5298);
  color: white;
  padding: 100px 0;
  transition: background 0.4s ease;
}

.hero h1 {
  font-size: 3.5rem;
  font-weight: bold;
  transition: color 0.3s ease;
}

.btn-custom {
  background: #ffffff;
  color: #007bff;
  border-radius: 30px;
  font-weight: 600;
  padding: 10px 25px;
  transition: 0.3s ease-in-out;
}

.btn-custom:hover {
  background: #007bff;
  color: #ffffff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Section Title */
.section-title {
  text-align: center;
  font-weight: bold;
  color: #ffffff;
  margin-bottom: 40px;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
  transition: color 0.3s ease;
}

/* Services */
.service-box {
  background: #1f1f2e;
  color: #f5f5f5;
  padding: 30px;
  border-radius: 12px;
  transition: 0.4s ease;
  text-align: center;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.service-box:hover {
  background-color: #eaf3ff;
  color: #1f1f2e;
  transform: translateY(-7px);
}

/* Why Choose Us */
.choose-us {
  background: #2c3e50;
  padding: 60px 0;
  transition: background 0.3s ease;
}

.choose-us .icon {
  font-size: 3rem;
  color: #0d6efd;
  transition: transform 0.3s ease;
}

.choose-us .icon:hover {
  transform: scale(1.2);
}

.choose-us h5 {
  color: #ffffff;
  margin-top: 15px;
}

.choose-us p {
  color: #cccccc;
}

/* Tutors Section */
.tutor-card {
  background: #1f1f2e;
  color: #f0f0f0;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.03);
  text-align: center;
  transition: 0.3s ease-in-out;
}

.tutor-card:hover {
  transform: translateY(-6px);
  background-color: #eaf3ff;
  color: #111;
}

/* Footer */
.footer {
  color: #c8c8c8;
  padding: 40px 0;
  transition: background 0.3s ease;
}

.footer a {
  color: #c8c8c8;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer a:hover {
  
  text-decoration: underline;
}.glowing-btn {
  background-color: #00bcd4;
  color: white;
  border-radius: 50px;
  padding: 14px 35px;
  font-size: 1.1rem;
  font-weight: 600;
  transition: all 0.4s ease;
  box-shadow: 0 0 12px rgba(0, 188, 212, 0.5), 0 0 40px rgba(0, 188, 212, 0.2);
}

.glowing-btn:hover {
  background-color: #0097a7;
  box-shadow: 0 0 20px rgba(0, 188, 212, 0.8), 0 0 60px rgba(0, 188, 212, 0.3);
  transform: translateY(-2px);
}


  </style>
</head>
<body>

<?php include 'navbar.php'; ?>
<!-- Hero Section -->
<section class="hero py-5 text-white" style="background: linear-gradient(to right, #141e30, #243b55); overflow: hidden;">
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <!-- Text Column -->
      <div class="col-lg-6 mb-5 mb-lg-0 animate__animated animate__fadeInLeft">
        <h1 class="display-4 fw-bold mb-3">
          Unlock Your Learning Potential with Top Tutors
        </h1>
        <p class="lead mb-4">
          Find experienced and verified tutors for every subject. Flexible scheduling, live classes, and interactive sessions — all in one place.
        </p>
        <a href="#tutors" class="btn btn-lg glowing-btn">
          <i class="fas fa-search me-2"></i> Browse Tutors
        </a>
      </div>

      <!-- Image Column -->
      <div class="col-lg-5 text-center animate__animated animate__fadeInRight">
        <img src="img/bg.png" alt="Online Tutoring" class="img-fluid rounded-circle shadow-lg" style="width: 100%; max-width: 450px;">
      </div>
    </div>
  </div>
</section>



<!-- Optional Animations CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<!-- Services Section -->
<section class="py-5">
  <div class="container">
    <h2 class="section-title">Our Services</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="service-box">
          <i class="fas fa-user-graduate fa-2x mb-3 text-primary"></i>
          <h5>User & Tutor Registration</h5>
          <p>Create an account to join our platform and access personalized learning.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-box">
          <i class="fas fa-search fa-2x mb-3 text-primary"></i>
          <h5>Find Tutors Easily</h5>
          <p>Use filters to search tutors by subject, category, experience, and area.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-box">
          <i class="fas fa-laptop-house fa-2x mb-3 text-primary"></i>
          <h5>Online Classes</h5>
          <p>Learn from home using Zoom/Meet links shared by our tutors.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="choose-us">
  <div class="container">
    <h2 class="section-title">Why Choose TutorFinder?</h2>
    <div class="row g-4">
      <div class="col-md-4 text-center">
        <div class="icon mb-2"><i class="fas fa-check-circle"></i></div>
        <h5>Verified Tutors</h5>
        <p>Every tutor is background-checked and verified by our admin team.</p>
      </div>
      <div class="col-md-4 text-center">
        <div class="icon mb-2"><i class="fas fa-clock"></i></div>
        <h5>Flexible Scheduling</h5>
        <p>Learn on your own time with sessions tailored to your convenience.</p>
      </div>
      <div class="col-md-4 text-center">
        <div class="icon mb-2"><i class="fas fa-thumbs-up"></i></div>
        <h5>Satisfaction Guarantee</h5>
        <p>We ensure quality learning and complete satisfaction at every step.</p>
      </div>
    </div>
  </div>
</section>

<!-- Tutors Section -->
<section class="py-5" id="tutors">
  <div class="container">
    <h2 class="section-title">Featured Tutors</h2>
    <div class="row g-4">
      <?php
      $conn = new mysqli("localhost", "root", "", "diya_tutor"); // Update DB
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM tutors ORDER BY id DESC LIMIT 6";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="col-md-4">
            <div class="tutor-card">
              <img src="img/'.$row['tutorPicture'].'" alt="Tutor" class="img-fluid rounded mb-3" style="height: 200px; width:100%; object-fit: cover;">
              <h5>'.$row['tutorName'].'</h5>
              <p>'.$row['tutorQualification'].' | '.$row['tutorCategory'].'</p>
              <p><strong>Fee:</strong> PKR '.$row['tutorFee'].'</p>
              <a href="user/register.php?id='.$row['id'].'" class="btn btn-outline-primary btn-lg w-100 mt-2">View Profile</a>
            </div>
          </div>';
        }
      } else {
        echo '<p class="text-center">No tutors found.</p>';
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>

- Footer -->
<footer class="footer text-light bg-dark pt-5 pb-4">
  <div class="container">
    <div class="row">

      <div class="col-md-4 mb-4">
        <h5 class="text-white fw-bold mb-3">TutorFinder</h5>
        <p>Connecting learners with the best tutors across Pakistan. Safe, reliable, and verified platform for quality learning.</p>
      </div>

      <div class="col-md-4 mb-4">
        <h5 class="text-white fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
          <li><a href="user/register.php" class="text-light text-decoration-none">Register</a></li>
          <li><a href="user/user_login.php" class="text-light text-decoration-none">User Login</a></li>
          <li><a href="tutor/tutor_login.php" class="text-light text-decoration-none">Tutor Login</a></li>
        </ul>
      </div>

      <div class="col-md-4 mb-4">
        <h5 class="text-white fw-bold mb-3">Contact Us</h5>
        <p><i class="fas fa-envelope me-2"></i> support@tutorfinder.pk</p>
        <p><i class="fas fa-phone me-2"></i> +92 300 1234567</p>
        <p><i class="fas fa-map-marker-alt me-2"></i> Lahore, Pakistan</p>
      </div>

    </div>
    <hr class="bg-light" />
    <p class="text-center mb-0">&copy; 2025 TutorFinder. All rights reserved.</p>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
