<?php
include('../db_connection.php');
include 'sidebar_admin.php'; 

// Fetch total tutor fees
$total_fee_query = "SELECT SUM(tutorFee) AS total_fee FROM tutors";
$total_fee_result = mysqli_query($conn, $total_fee_query);
$row = mysqli_fetch_assoc($total_fee_result);
$totalFee = $row['total_fee'];

$adminProfit = $totalFee * 0.20;
$tutorExpense = $totalFee * 0.80;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Report Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            padding: 10px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main content area */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        /* Cards on dashboard */
        .card {
            border-radius: 10px;
        }

        .card-header {
            font-size: 16px;
        }
           th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body style="background:#f0f2f5;">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar_admin.php'; ?>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <h2 class="text-center mb-4">Admin Expense & Profit Report</h2>
        <div class="row">

            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Income (Tutors)</div>
                    <div class="card-body">
                        <h5 class="card-title">Rs <?php echo number_format($totalFee, 2); ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Expenses (Paid to Tutors)</div>
                    <div class="card-body">
                        <h5 class="card-title">Rs <?php echo number_format($tutorExpense, 2); ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Admin Profit (20%)</div>
                    <div class="card-body">
                        <h5 class="card-title">Rs <?php echo number_format($adminProfit, 2); ?></h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mt-4">
            <div class="card-header bg-dark text-white">Tutors Earnings Breakdown</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th style="background-color:#003366;">ID</th>
                            <th style="background-color:#003366;">Name</th>
                            <th style="background-color:#003366;">Category</th>
                            <th style="background-color:#003366;">Fee</th>
                            <th style="background-color:#003366;">Admin Profit</th>
                            <th style="background-color:#003366;">Paid to Tutor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tutors_query = "SELECT * FROM tutors";
                        $tutors_result = mysqli_query($conn, $tutors_query);
                        while ($tutor = mysqli_fetch_assoc($tutors_result)) {
                            $fee = $tutor['tutorFee'];
                            $profit = $fee * 0.20;
                            $expense = $fee * 0.80;
                            echo "<tr>
                                <td>{$tutor['id']}</td>
                                <td>{$tutor['tutorName']}</td>
                                <td>{$tutor['tutorCategory']}</td>
                                <td>Rs " . number_format($fee, 2) . "</td>
                                <td>Rs " . number_format($profit, 2) . "</td>
                                <td>Rs " . number_format($expense, 2) . "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>
