<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Include database connection
require_once 'db_connect.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Delete the record using prepared statement
try {
    $stmt = $pdo->prepare("DELETE FROM course_table WHERE id = ?");
    $stmt->execute([$id]);
    
    // Set success message
    $_SESSION['success_message'] = "Grade record deleted successfully!";
} catch (PDOException $e) {
    // Set error message
    $_SESSION['error_message'] = "Error deleting record: " . $e->getMessage();
}

// Redirect back to dashboard
header("Location: dashboard.php");
exit;
?>