<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - EduConnect</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #6c63ff;
      --secondary: #4d44db;
      --accent: #ff6584;
      --light: #f8f9fa;
      --dark: #343a40;
      --success: #28a745;
      --info: #17a2b8;
      --warning: #ffc107;
      --danger: #dc3545;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #495057;
    
    }
    
    h1, h2, h3, h4, h5 {
      font-family: 'Playfair Display', serif;
    }
    
    .about-hero {
      background: linear-gradient(135deg, rgba(108, 99, 255, 0.8) 0%, rgba(77, 68, 219, 0.8) 100%), 
                  url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 100px 0;
      text-align: center;
    }
    
    .about-hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }
    
    .about-hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
    }
    
    .mission-vision {
      padding: 80px 0;
    }
    
    .mission-card, .vision-card {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: all 0.3s;
      height: 100%;
    }
    
    .mission-card:hover, .vision-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .mission-card i, .vision-card i {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 20px;
    }
    
    .team-section {
      padding: 80px 0;
      background-color: var(--light);
    }
    
    .team-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: all 0.3s;
      margin-bottom: 30px;
    }
    
    .team-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .team-img {
      height: 250px;
      overflow: hidden;
    }
    
    .team-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s;
    }
    
    .team-card:hover .team-img img {
      transform: scale(1.1);
    }
    
    .team-info {
      padding: 25px;
      text-align: center;
    }
    
    .team-info h5 {
      font-weight: 700;
      margin-bottom: 5px;
    }
    
    .team-info p {
      color: #6c757d;
      margin-bottom: 15px;
    }
    
    .social-links a {
      display: inline-block;
      width: 35px;
      height: 35px;
      line-height: 35px;
      text-align: center;
      background-color: rgba(108, 99, 255, 0.1);
      color: var(--primary);
      border-radius: 50%;
      margin: 0 5px;
      transition: all 0.3s;
    }
    
    .social-links a:hover {
      background-color: var(--primary);
      color: white;
      transform: translateY(-3px);
    }
    
    .stats-section {
      padding: 80px 0;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
    }
    
    .stat-item {
      text-align: center;
      padding: 20px;
    }
    
    .stat-item h2 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .stat-item p {
      font-size: 1.1rem;
      opacity: 0.9;
    }
    
    .testimonials {
      padding: 80px 0;
    }
    
    .testimonial-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      margin-bottom: 30px;
      transition: all 0.3s;
    }
    
    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .testimonial-card .stars {
      color: var(--warning);
      margin-bottom: 15px;
    }
    
    .testimonial-card .quote {
      font-style: italic;
      margin-bottom: 20px;
      position: relative;
    }
    
    .testimonial-card .quote::before {
      content: '"';
      font-size: 3rem;
      color: rgba(108, 99, 255, 0.2);
      position: absolute;
      top: -20px;
      left: -10px;
    }
    
    .testimonial-author {
      display: flex;
      align-items: center;
    }
    
    .testimonial-author img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }
    
    .author-info h6 {
      font-weight: 700;
      margin-bottom: 5px;
    }
    
    .author-info p {
      color: #6c757d;
      margin-bottom: 0;
    }
    
    .section-title {
      position: relative;
      margin-bottom: 60px;
      text-align: center;
    }
    
    .section-title h2 {
      font-weight: 700;
      color: var(--dark);
      position: relative;
      display: inline-block;
    }
    
    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--primary);
      border-radius: 2px;
    }
    
    .section-title.white h2 {
      color: white;
    }
    
    .section-title.white h2::after {
      background: white;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<section class="about-hero">
  <div class="container">
    <h1>About TutorConnect</h1>
    <p>We're revolutionizing education by connecting students with the perfect tutors for their learning needs. Our platform makes finding quality education accessible, convenient, and effective.</p>
  </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="mission-card">
          <i class="fas fa-bullseye"></i>
          <h3>Our Mission</h3>
          <p>To democratize education by providing every student with access to personalized, high-quality tutoring regardless of their location or background. We believe that every learner deserves the right guidance to unlock their full potential.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="vision-card">
          <i class="fas fa-eye"></i>
          <h3>Our Vision</h3>
          <p>To become the global leader in educational connections, transforming how students learn and tutors teach. We envision a world where geographical boundaries don't limit educational opportunities and where learning is tailored to individual needs.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
  <div class="container">
    <div class="section-title white">
      <h2>By The Numbers</h2>
    </div>
    <div class="row">
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <h2>1,250+</h2>
          <p>Qualified Tutors</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <h2>5,000+</h2>
          <p>Happy Students</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <h2>50+</h2>
          <p>Subjects Covered</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <h2>95%</h2>
          <p>Success Rate</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team-section">
  <div class="container">
    <div class="section-title">
      <h2>Meet Our Team</h2>
      <p class="text-muted">The passionate people behind EduConnect</p>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <div class="team-img">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Team Member">
          </div>
          <div class="team-info">
            <h5>Sarah Johnson</h5>
            <p>CEO & Founder</p>
            <div class="social-links">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fas fa-envelope"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <div class="team-img">
            <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Team Member">
          </div>
          <div class="team-info">
            <h5>Michael Chen</h5>
            <p>CTO</p>
            <div class="social-links">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-github"></i></a>
              <a href="#"><i class="fas fa-envelope"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <div class="team-img">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80" alt="Team Member">
          </div>
          <div class="team-info">
            <h5>Emily Rodriguez</h5>
            <p>Head of Education</p>
            <div class="social-links">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fas fa-envelope"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <div class="team-img">
            <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8f"></div></div></div></div></div></section></body></html>