<!-- user_sidebar.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        background-color: #212529;
        padding-top: 30px;
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
</style>

<div class="sidebar">
    <h4><i class="fas fa-user"></i> User Panel</h4>
<a href="welcome.php"><i class="fas fa-user-edit"></i> User Panel</a>
<a href="user_view_tutor.php"><i class="fas fa-chalkboard-teacher"></i> Browse Tutors</a>
<a href="my_tutors.php"><i class="fas fa-search"></i> My Tutors</a>
<a href="my_courses.php"><i class="fas fa-book"></i> My Courses</a>
<a href="view_quiz.php"><i class="fas fa-question-circle"></i> My Quizzes</a>
<a href="show_voucher.php"><i class="fas fa-upload"></i> View Voucher</a>
<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>

</div>
