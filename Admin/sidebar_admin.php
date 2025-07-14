<!-- admin_sidebar.php -->
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
    <h4><i class="fas fa-user-shield"></i> Admin Panel</h4>
    <a href="admin_dashboard.php"><i class="fas fa-cogs"></i> Management</a>
    <a href="analytics.php"><i class="fas fa-chart-line"></i> Check Analytics</a>
    <a href="generate_reports.php"><i class="fas fa-file-alt"></i> Generate Reports</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
