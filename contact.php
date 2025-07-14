<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - EduConnect</title>
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
    
    .contact-hero {
      background: linear-gradient(135deg, rgba(108, 99, 255, 0.8) 0%, rgba(77, 68, 219, 0.8) 100%), 
                  url('https://images.unsplash.com/photo-1516321318423-f06f85e504d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 100px 0;
      text-align: center;
    }
    
    .contact-hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }
    
    .contact-hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
    }
    
    .contact-section {
      padding: 80px 0;
    }
    
    .contact-card {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: all 0.3s;
      height: 100%;
    }
    
    .contact-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .contact-info {
      margin-bottom: 50px;
    }
    
    .contact-info-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 30px;
    }
    
    .contact-info-icon {
      width: 60px;
      height: 60px;
      background: rgba(108, 99, 255, 0.1);
      color: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-right: 20px;
      flex-shrink: 0;
    }
    
    .contact-info-content h4 {
      font-weight: 600;
      margin-bottom: 5px;
    }
    
    .contact-info-content p {
      color: #6c757d;
      margin-bottom: 0;
    }
    
    .contact-info-content a {
      color: var(--primary);
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .contact-info-content a:hover {
      color: var(--secondary);
    }
    
    .form-control {
      height: 50px;
      border-radius: 10px;
      border: 1px solid #e9ecef;
      padding-left: 20px;
      margin-bottom: 20px;
      transition: all 0.3s;
    }
    
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
    }
    
    textarea.form-control {
      height: auto;
      padding-top: 15px;
      min-height: 150px;
    }
    
    .btn-send {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 12px 30px;
      font-weight: 500;
      border-radius: 50px;
      transition: all 0.3s;
    }
    
    .btn-send:hover {
      background-color: var(--secondary);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .map-container {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      height: 100%;
      min-height: 400px;
    }
    
    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
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
    
    .social-links {
      margin-top: 30px;
    }
    
    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: rgba(108, 99, 255, 0.1);
      color: var(--primary);
      border-radius: 50%;
      margin-right: 10px;
      transition: all 0.3s;
    }
    
    .social-links a:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }
    
    @media (max-width: 768px) {
      .contact-hero h1 {
        font-size: 2.5rem;
      }
      
      .contact-hero p {
        font-size: 1rem;
      }
      
      .contact-info-item {
        flex-direction: column;
        text-align: center;
      }
      
      .contact-info-icon {
        margin-right: 0;
        margin-bottom: 15px;
        margin-left: auto;
        margin-right: auto;
      }
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<section class="contact-hero">
  <div class="container">
    <h1>Get In Touch</h1>
    <p>Have questions or feedback? We'd love to hear from you! Our team is ready to assist you with any inquiries.</p>
  </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5">
        <div class="contact-card">
          <div class="section-title" style="text-align: left;">
            <h2>Contact Information</h2>
            <p class="text-muted">We're here to help you with any questions</p>
          </div>
          
          <div class="contact-info">
            <div class="contact-info-item">
              <div class="contact-info-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="contact-info-content">
                <h4>Our Location</h4>
                <p>123 Education Street, Suite 456<br>San Francisco, CA 94107</p>
              </div>
            </div>
            
            <div class="contact-info-item">
              <div class="contact-info-icon">
                <i class="fas fa-phone-alt"></i>
              </div>
              <div class="contact-info-content">
                <h4>Phone Number</h4>
                <p><a href="tel:+18005551234">+1 (800) 555-1234</a><br>
                <a href="tel:+14155556789">+1 (415) 555-6789</a></p>
              </div>
            </div>
            
            <div class="contact-info-item">
              <div class="contact-info-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="contact-info-content">
                <h4>Email Address</h4>
                <p><a href="mailto:info@educonnect.com">info@educonnect.com</a><br>
                <a href="mailto:support@educonnect.com">support@educonnect.com</a></p>
              </div>
            </div>
          </div>
          
          <div class="social-links">
            <h5>Follow Us</h5>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
      
      <div class="col-lg-7">
        <div class="contact-card">
          <div class="section-title" style="text-align: left;">
            <h2>Send Us a Message</h2>
            <p class="text-muted">Fill out the form below and we'll get back to you soon</p>
          </div>
          
          <form id="contactForm">
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" placeholder="Your Email" required>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Subject">
            <textarea class="form-control" placeholder="Your Message" required></textarea>
            <div class="text-center">
              <button type="submit" class="btn btn-send">
                <i class="fas fa-paper-plane me-2"></i> Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="row mt-5">
      <div class="col-12">
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.158170980978!2d-122.4036639245374!3d37.7877433718902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858062b7d7e6f9%3A0x1a3b1b1b1b1b1b1b!2s123%20Education%20St%2C%20San%20Francisco%2C%20CA%2094107!5e0!3m2!1sen!2sus!4v1689876543210!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="section-title">
      <h2>Frequently Asked Questions</h2>
      <p class="text-muted">Quick answers to common questions</p>
    </div>
    
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
            <i class="fas fa-question-circle text-primary me-2"></i> How do I find the right tutor for me?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            You can browse our tutor profiles by subject, location, experience level, and ratings. Each tutor has a detailed profile with their qualifications, teaching style, and availability. You can also use our matching quiz to get personalized recommendations.
          </div>
        </div>
      </div>
      
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
            <i class="fas fa-question-circle text-primary me-2"></i> What are your payment options?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers. Payments are processed securely through our platform, and you'll receive a receipt for each transaction. We also offer flexible payment plans for long-term tutoring arrangements.
          </div>
        </div>
      </div>
      
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
            <i class="fas fa-question-circle text-primary me-2"></i> Can I schedule a trial session?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes! Many of our tutors offer discounted or free trial sessions so you can ensure they're the right fit before committing to regular sessions. You can filter for tutors who offer trials when searching, or request one when contacting a tutor directly.
          </div>
        </div>
      </div>
      
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
            <i class="fas fa-question-circle text-primary me-2"></i> How do online tutoring sessions work?
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Online sessions are conducted through our secure platform using video conferencing tools like Zoom or Google Meet. You'll receive a link to join your session at the scheduled time. Our platform includes interactive whiteboards, file sharing, and session recording (with permission) to enhance the learning experience.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Form submission handling
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Here you would typically send the form data to your server
    // For this example, we'll just show a success message
    alert('Thank you for your message! We will get back to you soon.');
    this.reset();
  });
</script>
</body>
</html>