<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

include '../db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $category_name = trim($_POST['category_name']);
    if (empty($category_name)) {
        $error_message = "Category name is required!";
    } else {
        // Prepare SQL query to insert category
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
        $stmt->bind_param("s", $category_name); // Bind the parameter

        if ($stmt->execute()) {
            $success_message = "Category added successfully!";
        } else {
            $error_message = "There was an error adding the category.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            color: white;
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

        /* Main content area styles */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn {
            font-weight: bold;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar_admin.php'; ?>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h2 class="text-center mb-4">Add New Category</h2>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="add_category.php" method="POST">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                        <a href="admin_dashboard.php" class="btn btn-secondary btn-block mt-3">Back to Dashboard</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
