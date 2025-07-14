<!-- tutor_sidebar.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        background-color: #212529;
        padding-top: 30px;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    .sidebar a {
        display: flex;
        align-items: center;
        color: white;
        padding: 12px 25px;
        text-decoration: none;
        transition: 0.3s;
    }
    .sidebar a:hover {
        background-color: #343a40;
                    padding-left: 10px;

    }
    .sidebar i {
        margin-right: 10px; 
    }
    .sidebar h4 {
        color: #ffc107;
        text-align: center;
        margin-bottom: 30px;
    }
    /* Ensuring content doesn't overlap with sidebar */
    .main-content {
        margin-left: 260px; /* Adjust based on sidebar width */
        padding: 30px;
        background-color: #f8f9fa;
    }
</style>

<div class="sidebar">
    <h4><i class="fas fa-user-graduate"></i> Tutor Panel</h4>
    <a href="tutor_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="upload_resume.php"><i class="fas fa-upload"></i> Upload Resume</a>
    <a href="view_student.php"><i class="fas fa-envelope"></i> My Students</a>
        <a href="tutor_class_links.php"><i class="fas fa-upload"></i> Create Class Link</a>

        <a href="generate_quiz.php"><i class="fas fa-envelope"></i> Generate Quiz</a>
                <a href="all_quiz.php"><i class="fas fa-envelope"></i> All Quiz</a>


    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
