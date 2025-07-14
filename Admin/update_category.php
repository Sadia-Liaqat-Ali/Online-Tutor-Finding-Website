<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $category_name = trim($_POST['category_name']);

    if (!empty($category_name)) {
        $stmt = $conn->prepare("UPDATE categories SET category_name = ? WHERE id = ?");
        $stmt->bind_param("si", $category_name, $category_id);
        $stmt->execute();
    }
}

header("Location: manage_category.php");
exit;
