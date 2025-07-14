<!-- nav.php -->
<style>
  .navbar {
    background: silver;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 0.8rem 1rem;
    transition: background 0.3s ease;
  }

  .navbar-brand {
    font-size: 1.7rem;
    color: #0d6efd !important;
    transition: color 0.3s ease;
  }

  .navbar-brand:hover {
    color: #084298 !important;
  }

  .nav-link {
    position: relative;
    margin: 0 12px;
    font-size: 1.05rem;
    color: #333 !important;
    transition: color 0.3s ease, transform 0.2s ease;
  }

  .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background-color: #0d6efd;
    transition: width 0.3s ease-in-out;
  }

  .nav-link:hover {
    color: #0d6efd !important;
    transform: translateY(-2px);
  }

  .nav-link:hover::after {
    width: 100%;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' fill='%23000' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0,0,0,0.6)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
</style>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <i class="fas fa-chalkboard-teacher me-1"></i> TutorFinder
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto fw-semibold">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="user/register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="user/user_login.php">User Login</a></li>
        <li class="nav-item"><a class="nav-link" href="tutor/tutor_login.php">Tutor Login</a></li>
        <li class="nav-item"><a class="nav-link" href="admin/admin_login.php">Admin Login</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>
